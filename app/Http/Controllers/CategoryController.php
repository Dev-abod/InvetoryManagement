<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $editCategory = null;

        if ($request->has('edit')) {
            $editCategory = Category::find($request->edit);
        }

        return view('Sub_ProductManagement.Categories', compact(
            'categories',
            'editCategory'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return redirect()->route('Categories');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name
        ]);

        return redirect()->route('Categories');
    }

    public function destroy($id)
{
    $category = Category::findOrFail($id);

    // التحقق هل الفئة مرتبطة بأصناف
    if ($category->items()->exists()) {
        return redirect()
            ->route('Categories')
            ->withErrors([
                'delete' => 'Cannot delete this category because it is linked to existing items.'
            ]);
    }

    $category->delete();

    return redirect()
        ->route('Categories')
        ->with('success', 'Category deleted successfully.');
}
}
