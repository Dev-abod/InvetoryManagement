<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Http\JsonResponse;
use App\Models\Warehouse;
use App\Models\Partner;

class OperationController extends Controller
{
    //
    public function create(string $type)
{
    // التحقق من نوع العملية
    $this->validateOperationType($type);

    // جلب جميع المخازن
    $warehouses = Warehouse::orderBy('name')->get();

    // تحديد نوع الطرف (مورد / عميل) حسب العملية
    // in , return_in  => مورد
    // out, return_out => عميل
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
private function pageTitle(string $type): string
{
    return match ($type) {
        'in'         => 'عملية توريد مخزني',
        'out'        => 'عملية صرف مخزني',
        'return_in'  => 'مردود توريد',
        'return_out' => 'مردود صرف',
        default      => 'عملية مخزنية',
    };
}

private function partnerLabel(string $type): string
{
    return in_array($type, ['in', 'return_in'])
        ? 'المورد'
        : 'العميل';
}
private function validateOperationType(string $type): void
{
    $allowed = ['in', 'out', 'return_in', 'return_out', 'adjustment'];

    if (!in_array($type, $allowed)) {
        abort(404);
    }
}
/**
 * جلب جميع الأصناف لعرضها في Popup
 */
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

}
