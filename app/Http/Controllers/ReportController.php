<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\Operation;
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
}
