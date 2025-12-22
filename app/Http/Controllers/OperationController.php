<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;



use App\Models\Item;
use App\Models\Warehouse;
use App\Models\Partner;
use App\Models\Operation;
use App\Models\OperationDetail;
use App\Models\Stock;
use App\Models\StockMovement;

class OperationController extends Controller
{
    public function index(string $type)
{
    // التحقق من نوع العملية
    $this->validateOperationType($type);

    // جلب العمليات حسب النوع
    $operations = Operation::with(['partner', 'warehouse'])
        ->where('operation_type', $type)
        ->orderByDesc('date')
        ->paginate(10);

    return view('operations.index', [
        'type'       => $type,
        'pageTitle'  => $this->pageTitle($type),
        'operations' => $operations,
    ]);
}


    /* =====================================================
       عرض شاشة إنشاء عملية
       ===================================================== */
    public function create(string $type)
    {
        $this->validateOperationType($type);

        $warehouses = Warehouse::orderBy('name')->get();

        $partners = Partner::where(
            'type',
            in_array($type, ['in', 'return_in']) ? 'supplier' : 'customer'
        )->orderBy('name')->get();

        return view('operations.create', [
            'type'         => $type,
            'pageTitle'    => $this->pageTitle($type),
            'partnerLabel' => $this->partnerLabel($type),
            'warehouses'   => $warehouses,
            'partners'     => $partners,
        ]);
    }

    /* =====================================================
       حفظ عملية جديدة
       ===================================================== */
    public function store(Request $request, string $type)
    {
        $this->validateOperationType($type);
        $validated = $this->validateRequest($request, $type);

        DB::transaction(function () use ($validated, $type) {

            // منع الصرف بدون رصيد
            if (in_array($type, ['out', 'return_in'])) {
                $this->checkStockAvailability(
                    $validated['items'],
                    $validated['warehouse_id']
                );
            }

            // إنشاء رأس العملية
            $operation = Operation::create([
                'operation_type' => $type,
                'date'           => $validated['date'],
                'number'         => $this->generateOperationNumber($type),
                'notes'          => $validated['notes'] ?? null,
                'partner_id'     => $validated['partner_id'] ?? null,
                'warehouse_id'   => $validated['warehouse_id'],
                'user_id'        => Auth::user()->id,
                'status'         => 'posted',
            ]);

            $effect = $this->stockEffect($type);

            // التفاصيل + المخزون + Ledger
            foreach ($validated['items'] as $item) {

                OperationDetail::create([
                    'operation_id' => $operation->id,
                    'item_id'      => $item['item_id'],
                    'quantity'     => (int) $item['quantity'],
                    'expiry_date'  => $item['expiry_date'] ?? null,
                ]);

                $this->applyStockChange(
                    itemId: $item['item_id'],
                    warehouseId: $validated['warehouse_id'],
                    change: $effect * (int) $item['quantity'],
                    operation: $operation
                );
            }
        });

        return back()->with('success', 'تم حفظ العملية بنجاح');
    }

    /* =====================================================
       show operation
       ===================================================== */
       public function show(Operation $operation)
{
    $operation->load([
        'partner',
        'warehouse',
        'details.item.unit',
        'details.item.category',
    ]);

    return view('operations.show', [
        'operation' => $operation,
        'pageTitle' => 'Operation Details',
    ]);
}


    /* =====================================================
       جلب الأصناف (Popup)
       ===================================================== */
    public function popupItems(): JsonResponse
    {
        $items = Item::with(['category', 'unit'])
            ->orderBy('name')
            ->get()
            ->map(function ($item) {
                return [
                    'id'       => $item->id,
                    'name'     => $item->name,
                    'barcode'  => $item->barcode,
                    'category' => $item->category?->name,
                    'unit'     => $item->unit?->name,
                ];
            });

        return response()->json($items);
    }

    /* =====================================================
       Helpers
       ===================================================== */

    private function validateOperationType(string $type): void
    {
        $allowed = ['in', 'out', 'return_in', 'return_out', 'adjustment'];

        if (!in_array($type, $allowed)) {
            abort(404);
        }
    }

    private function validateRequest(Request $request, string $type): array
    {
        $rules = [
            'date'             => 'required|date',
            'warehouse_id'     => 'required|exists:warehouses,id',
            'items'            => 'required|array|min:1',
            'items.*.item_id'  => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'notes'            => 'nullable|string',
        ];

        if ($type !== 'adjustment') {
            $rules['partner_id'] = 'required|exists:partners,id';
        }

        if ($type === 'in') {
            $rules['items.*.expiry_date'] = 'required|date';
        }

        return $request->validate($rules);
    }

    private function stockEffect(string $type): int
    {
        return match ($type) {
            'in', 'return_out'  => +1,
            'out', 'return_in'  => -1,
        };
    }

    /**
     * فحص توفر المخزون (مُجمّع – احترافي)
     */
    private function checkStockAvailability(array $items, int $warehouseId): void
    {
        $grouped = collect($items)->groupBy('item_id');

    foreach ($grouped as $itemId => $rows) {
        $totalQty = $rows->sum('quantity');

        $stock = Stock::where([
            'item_id'      => $itemId,
            'warehouse_id' => $warehouseId,
        ])->first();

        if (!$stock || $stock->quantity < $totalQty) {
            throw ValidationException::withMessages([
                'items' => 'الكمية غير متوفرة في المخزون',
            ]);
        }
    }
    }

    private function applyStockChange(
        int $itemId,
        int $warehouseId,
        int $change,
        Operation $operation
    ): void {
        $stock = Stock::firstOrCreate(
            ['item_id' => $itemId, 'warehouse_id' => $warehouseId],
            ['quantity' => 0]
        );

        $newBalance = $stock->quantity + $change;

        $stock->update(['quantity' => $newBalance]);

        StockMovement::create([
            'item_id'         => $itemId,
            'warehouse_id'    => $warehouseId,
            'operation_id'    => $operation->id,
            'operation_type'  => $operation->operation_type,
            'quantity_change' => $change,
            'balance_after'   => $newBalance,
        ]);
    }

    private function pageTitle(string $type): string
    {
        return match ($type) {
            'in'         => 'Supply',
            'out'        => 'Exchange',
            'return_in'  => 'Supply Return',
            'return_out' => 'Exchange Return',
            default      => 'Operation',
        };
    }

    private function partnerLabel(string $type): string
    {
        return in_array($type, ['in', 'return_in'])
            ? 'المورد'
            : 'العميل';
    }
    private function generateOperationNumber(string $type): string
{
    $year = now()->year;

    $typeCode = match ($type) {
        'in'         => 1,
        'out'        => 2,
        'return_out' => 3,
        'return_in'  => 4,
        default      => 0,
    };

    // آخر رقم لنفس السنة ونفس النوع
    $lastOperation = Operation::whereYear('date', $year)
        ->where('operation_type', $type)
        ->orderByDesc('id')
        ->first();

    $nextSequence = 1;

    if ($lastOperation && $lastOperation->number) {
        // مثال: 2025-1-0007
        $parts = explode('-', $lastOperation->number);
        $nextSequence = ((int) end($parts)) + 1;
    }

    return sprintf(
        '%d-%d-%04d',
        $year,
        $typeCode,
        $nextSequence
    );
}

}
