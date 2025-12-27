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
        $partners = Partner::whereIn('type', [$type, 'both'])->get();

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
    public function store(Request $request)
    {
        $request->validate([
            'Supplier_Name'  => 'required|string|max:255',
            'Supplier_Phone' => 'nullable|string|max:50',
            'type'           => 'required|in:supplier,customer',
        ]);

        $partner = Partner::where('name', $request->Supplier_Name)->first();

        if ($partner) {

            // نفس النوع
            if ($partner->type === $request->type) {
                return back()->with(
                    'info',
                    'This partner already exists in this section.'
                );
            }

            // موجود في القسم الآخر → BOTH
            if ($partner->type !== 'both') {
                $oldType = $partner->type;

                $partner->update([
                    'type'  => 'both',
                    'phone' => $request->Supplier_Phone ?? $partner->phone,
                ]);

                return back()->with(
                    'warning',
                    "This partner already exists as " . ucfirst($oldType) .
                        " and has been added to both sections."
                );
            }

            // already both
            return back()->with(
                'info',
                'This partner already exists in both sections.'
            );
        }

        // إضافة جديد
        Partner::create([
            'name'  => $request->Supplier_Name,
            'phone' => $request->Supplier_Phone,
            'type'  => $request->type,
        ]);

        return back()->with('success', 'Partner added successfully.');
    }

public function update(Request $request, $id)
{
    $partner = Partner::findOrFail($id);

    if ($partner->operations()->exists()) {
        return response()->json([
            'status' => 'error',
            'message' => 'لا يمكن تعديل هذا الطرف لأنه مرتبط بعمليات أخرى'
        ], 400);
    }

    $request->validate([
        'Supplier_Name'  => 'required|string|max:255',
        'Supplier_Phone' => 'nullable|string|max:50',
    ]);

    $partner->update([
        'name'  => $request->Supplier_Name,
        'phone' => $request->Supplier_Phone,
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'تم تعديل الطرف بنجاح'
    ]);
}


    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);

        // أي نوع (customer / supplier / both)
        if ($partner->operations()->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'لا يمكن حذف هذا الطرف لأنه مرتبط بعمليات أخرى'
            ], 400);
        }

        $partner->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'تم حذف الطرف بنجاح'
        ]);
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
            'search' => 'required|string|max:255',
        ]);

        $search = trim($request->search);

        $partners = Partner::query()
            ->when(is_numeric($search), function ($q) use ($search) {
                $q->where('id', (int)$search);
            })
            ->when(!is_numeric($search), function ($q) use ($search) {
                $q->where('name', 'ILIKE', "%{$search}%");
            })
            ->get();

        if ($partners->isEmpty()) {
            return back()->with('info', 'No partner found');
        }

        return back()->with('searchPartners', $partners);
    }
}
