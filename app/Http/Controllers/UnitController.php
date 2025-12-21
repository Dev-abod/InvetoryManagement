<?php
namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        $units = Unit::all();
        $editUnit = null;

        if ($request->has('edit')) {
            $editUnit = Unit::find($request->edit);
        }

        return view(
            'Sub_ProductManagement.Units',
            compact('units', 'editUnit')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Unit::create([
            'name' => $request->name
        ]);

        return redirect()->route('Units');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Unit::findOrFail($id)->update([
            'name' => $request->name
        ]);

        return redirect()->route('Units');
    }

    public function destroy($id)
    {
        Unit::findOrFail($id)->delete();
        return redirect()->route('Units');
    }
}
