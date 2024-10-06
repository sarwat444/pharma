<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Medicine;
use App\Traits\ResponseJson;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request ;

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
    public  function add_invoice()
    {
        return view('admins.invoices.add_invoice') ;

    }
    // Handle the medicine search by name or code
    public function search (Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $medicines = Medicine::where('name', 'LIKE', '%' . $query . '%')
                ->orWhere('code', 'LIKE', '%' . $query . '%')
                ->get(['id', 'name', 'code', 'price' , 'quinity']);

            return response()->json($medicines);
        }

        return response()->json([]);
    }

    // Store or update an invoice
    public function store(Request $request)
    {
        // Start transaction to ensure data consistency
        DB::beginTransaction();

        try {
            // Create the invoice
            $invoice = Invoice::create([
                'invoice_number' => $request->invoice_number,
                'invoice_date' => $request->invoice_date,
            ]);

            // Loop through medicines and update their stock
            foreach ($request->medicines as $medicineData) {
                $medicine = Medicine::where('name', $medicineData['name'])->first();

                if ($medicine && $medicine->quantity >= $medicineData['quantity']) {
                    // Add medicine to the invoice
                    $invoice->medicines()->attach($medicine->id, [
                        'quantity' => $medicineData['quantity'],
                        'price' => $medicine->price,
                    ]);

                    // Update the stock
                    $medicine->quantity -= $medicineData['quantity'];
                    $medicine->save();
                } else {
                    // If stock is insufficient, throw an error
                    return response()->json([
                        'message' => "المخزون غير كاف للدواء: {$medicineData['name']}"
                    ], 400);
                }
            }

            DB::commit();

            return response()->json(['message' => 'تم حفظ الفاتورة بنجاح!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'حدث خطأ أثناء حفظ الفاتورة.'], 500);
        }
    }

    // Calculate the total amount of the invoice
    protected function calculateTotalAmount($medicines)
    {
        $total = 0;
        foreach ($medicines as $medicine) {
            $total += $medicine['price'] * $medicine['quantity'];
        }
        return $total;
    }

    // Show the details of an invoice (optional, if needed)
    public function show($id)
    {
        $invoice = Invoice::with('medicines')->findOrFail($id);

        return view('admins.invoices.show', compact('invoice'));
    }
    public function updateQuantity(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'id' => 'required|exists:medicines,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $medicine = Medicine::findOrFail($request->id);

        // Check if the requested quantity can be deducted
        if ($medicine->quantity < $request->quantity) {
            return response()->json(['error' => 'Insufficient quantity available.'], 400);
        }

        // Deduct the quantity
        $medicine->quantity -= $request->quantity;
        $medicine->save();

        return response()->json(['success' => 'Quantity updated successfully.']);
    }

}
