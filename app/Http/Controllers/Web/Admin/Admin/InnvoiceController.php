<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Traits\ResponseJson;
use Symfony\Component\HttpFoundation\Response;

class InnvoiceController extends Controller
{
    use  ResponseJson ;

    public function index()
    {
        return view('admins.invoices.index');
    }

    public function data()
    {
        $invoices = Invoice::select(['id', 'invoice_number', 'total_amount', 'invoice_date']);

        return datatables()->of($invoices)
            ->addColumn('action', function($invoice) {
                return '<button class="btn btn-sm btn-primary edit-btn" data-id="'.$invoice->id.'">Edit</button>';
            })
            ->make(true);
    }
    public function store(Request $request)
    {
        $invoice = Invoice::create([
            'invoice_number' => $request->input('invoice_number'),
            'invoice_date' => $request->input('invoice_date'),
            'total_amount' => $request->input('total_amount'),
        ]);

        foreach ($request->input('medicine_ids') as $index => $medicineId) {
            $quantity = $request->input('quantities')[$index];
            $price = $request->input('prices')[$index];

            $invoice->medicines()->attach($medicineId, [
                'quantity' => $quantity,
                'price' => $price
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        $invoice->update([
            'invoice_number' => $request->input('invoice_number'),
            'invoice_date' => $request->input('invoice_date'),
            'total_amount' => $request->input('total_amount'),
        ]);

        $invoice->medicines()->detach();

        foreach ($request->input('medicine_ids') as $index => $medicineId) {
            $quantity = $request->input('quantities')[$index];
            $price = $request->input('prices')[$index];

            $invoice->medicines()->attach($medicineId, [
                'quantity' => $quantity,
                'price' => $price
            ]);
        }

        return response()->json(['success' => true]);
    }

}
