<?php
namespace App\Http\Controllers;

use App\Models\Item;

class ProductManagementController extends Controller
{
    public function index()
    {
        // جلب كل المنتجات مع العلاقات
        $products = Item::with(['category', 'unit'])->get();

        return view('ProductManagement', compact('products'));
    }
}
