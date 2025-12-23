<?php

namespace App\Http\Controllers;
use App\Models\Item;
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
}
