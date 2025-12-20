<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::all();
        return view('partners.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Supplier_Name' => 'required|string',
            'Supplier_Phone' => 'required|string',
        ]);

        Partner::create($request->only([
            'Supplier_Name',
            'Supplier_Phone'
        ]));

        return back()->with('success', 'Partner added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);

        $request->validate([
            'Supplier_Name' => 'required|string',
            'Supplier_Phone' => 'required|string',
        ]);

        $partner->update($request->only([
            'Supplier_Name',
            'Supplier_Phone'
        ]));

        return back()->with('success', 'Partner updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $partner = Partner::find($id);

        if (!$partner) {
            return back()->withErrors('Partner not found');
        }

        $partner->delete();
        return back()->with('success', 'Partner deleted');
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|integer',
        ]);

        $partner = Partner::where('id', $request->search)->first();

        if (!$partner) {
            return redirect()
                ->route('partners.index')
                ->with('info', 'لم يتم العثور على شريك بهذا الرقم');
        }

        return redirect()
            ->route('partners.index')
            ->with('partner', $partner);
    }
}
