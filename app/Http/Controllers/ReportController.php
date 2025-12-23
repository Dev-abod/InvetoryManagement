<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\StockMovement;
use App\Models\Category;
use App\Models\Operation;
use App\Models\Warehouse;
use App\Models\Stock;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
     /**
     * Reports dashboard (cards page)
     */
    public function index()
    {
        return view('reports.index', [
            // عدد المنتجات
            'itemsCount' => Item::count(),

            // عدد العمليات المخزنية
            'operationsCount' => Operation::count(),

            // إجمالي الأصناف الموجودة في المخزون (بدون حساب يدوي)
            'stocksCount' => Stock::count(),
        ]);
    }
    public function stocks()
{
    $stocks = Stock::with(['item', 'warehouse'])
        ->orderBy('warehouse_id')
        ->orderBy('item_id')
        ->get();

    return view('reports.stocks', [
        'stocks'    => $stocks,
        'pageTitle' => 'Current Stock Report',
    ]);
}

  public function operations(Request $request)
    {
        $query = Operation::with(['warehouse','partner','user']);

        // 🔹 filter by operation type
        if ($request->filled('type')) {
            $query->where('operation_type', $request->type);
        }

        // 🔹 filter by status (posted / corrected / cancelled)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 🔹 date from
        if ($request->filled('from')) {
            $query->whereDate('date', '>=', $request->from);
        }

        // 🔹 date to
        if ($request->filled('to')) {
            $query->whereDate('date', '<=', $request->to);
        }

        // 🔹 warehouse
        if ($request->filled('warehouse_id')) {
            $query->where('warehouse_id', $request->warehouse_id);
        }

        return view('reports.operations', [
            'operations' => $query->latest()->paginate(20),
            'warehouses' => Warehouse::orderBy('name')->get(),
            'filters'    => $request->only([
                'type','status','from','to','warehouse_id'
            ]),
        ]);
    }

     public function stockMovements(Request $request)
    {
        // =========================
        // Filters
        // =========================
        $itemId       = $request->item_id;
        $categoryId   = $request->category_id;
        $warehouseId  = $request->warehouse_id;
        $fromDate     = $request->from;
        $toDate       = $request->to;
        $status       = $request->status; // posted / corrected / cancelled

        // =========================
        // Main Query
        // =========================
        $movements = StockMovement::query()
            ->with([
                'item.category',
                'warehouse',
                'operation.user'
            ])
            ->whereHas('operation', function ($q) use ($status) {
                // تجاهل العمليات الملغاة افتراضيًا
                if ($status) {
                    $q->where('status', $status);
                } else {
                    $q->where('status', '!=', 'cancelled');
                }
            });

        // =========================
        // Item Filter
        // =========================
        if ($itemId) {
            $movements->where('item_id', $itemId);
        }

        // =========================
        // Category Filter
        // =========================
        if ($categoryId) {
            $movements->whereHas('item', function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            });
        }

        // =========================
        // Warehouse Filter
        // =========================
        if ($warehouseId) {
            $movements->where('warehouse_id', $warehouseId);
        }

        // =========================
        // Date Filters
        // =========================
        if ($fromDate) {
            $movements->whereDate('created_at', '>=', $fromDate);
        }

        if ($toDate) {
            $movements->whereDate('created_at', '<=', $toDate);
        }

        // =========================
        // Order & Pagination
        // =========================
        $movements = $movements
            ->orderBy('created_at', 'asc')
            ->paginate(25)
            ->withQueryString();

        // =========================
        // Data for Filters UI
        // =========================
        $items      = Item::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $warehouses = Warehouse::orderBy('name')->get();

        return view('reports.stock_movements', [
            'movements'  => $movements,
            'items'      => $items,
            'categories' => $categories,
            'warehouses' => $warehouses,
            'filters'    => $request->all(),
        ]);
    }
}
