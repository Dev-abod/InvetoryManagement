<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products   = Item::with(['category', 'unit'])->get();
        $categories = Category::all();
        $units      = Unit::all();

        $editProduct = null;
        if ($request->has('edit')) {
            $editProduct = Item::find($request->edit);
        }

        return view(
            'Sub_ProductManagement.Products',
            compact('products', 'categories', 'units', 'editProduct')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'barcode'     => 'required',
            'name'        => 'required',
            'category_id' => 'required',
            'unit_id'     => 'required',
        ]);

        Item::create([
            'barcode'     => $request->barcode,
            'name'        => $request->name,
            'category_id' => $request->category_id,
            'unit_id'     => $request->unit_id,
        ]);

        return redirect()->route('Products');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'barcode'     => 'required',
            'name'        => 'required',
            'category_id' => 'required',
            'unit_id'     => 'required',
        ]);

        Item::findOrFail($id)->update([
            'barcode'     => $request->barcode,
            'name'        => $request->name,
            'category_id' => $request->category_id,
            'unit_id'     => $request->unit_id,
        ]);

        return redirect()->route('Products');
    }

   public function destroy($id)
{
    $item = Item::findOrFail($id);

    // 🔒 التحقق الأساسي: هل الصنف مستخدم في أي عملية؟
    if ($item->operationDetails()->exists()) {
        return redirect()
            ->route('Products')
            ->withErrors([
                'delete' => 'Cannot delete this item because it has been used in inventory operations.'
            ]);
    }

    // ✅ مسموح بالحذف
    $item->delete();

    return redirect()
        ->route('Products')
        ->with('success', 'Item deleted successfully.');
}
}
