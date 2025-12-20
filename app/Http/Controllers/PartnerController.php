<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Partner;

class PartnerController extends Controller
{
    /* ================= SUPPLIERS ================= */
    public function suppliers()
    {
        return $this->renderPartnersPage('supplier');
    }

    /* ================= CUSTOMERS ================= */
    public function customers()
    {
        return $this->renderPartnersPage('customer');
    }

    /* ================= SHARED VIEW LOGIC ================= */
    private function renderPartnersPage(string $type)
    {
        $partners = Partner::where('type', $type)->get();

        if ($type === 'supplier') {
            $List  = 'Supplier List';
            $Name  = 'Supplier Name';
            $Phone = 'Supplier Phone';
            $Show  = 'Show All Suppliers';
            $Add   = 'Supplier';
        } else {
            $List  = 'Customer List';
            $Name  = 'Customer Name';
            $Phone = 'Customer Phone';
            $Show  = 'Show All Customers';
            $Add   = 'Customer';
        }

        return view('Partners', compact(
            'partners',
            'List',
            'Name',
            'Phone',
            'Show',
            'Add',
            'type'
        ));
    }



public function exportPdf(string $type)
{
    $partners = Partner::where('type', $type)->get();

    $title = $type === 'supplier'
        ? 'Suppliers List'
        : 'Customers List';

    return Pdf::loadView('partners_pdf', compact('partners', 'title'))
        ->download($title . '.pdf');
}

    /* ================= SEARCH ================= */
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|integer',
        ]);

        $partner = Partner::find($request->search);

        if (!$partner) {
            return back()->with('info', 'No partner found with this ID');
        }

        return back()->with('partner', $partner);
    }
}
