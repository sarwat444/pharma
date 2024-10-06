<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Output\StoreInnvoiceRequest;
use App\Http\Requests\Web\Admin\Output\UpdateInnvoiceRequest;
use App\Models\InnvoiceWeek;
use App\Models\Program;
use App\Traits\ResponseJson;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WeekInnvoiceController extends Controller
{
    use  ResponseJson ;
    public function __construct(private readonly InnvoiceWeek $InnvoiceModel)
    {}
    public  function  show($program_id =null)
    {
        $program = Program::find($program_id) ;
        $Innvoices = $this->InnvoiceModel->where('program_id' , $program_id )->get();
        return view('admins.programs.details.Innvoices.index', compact('Innvoices' , 'program'));
    }
    public function create(): \Illuminate\View\View
    {
        return view('admins.Innvoice.create');
    }
    public function store(StoreInnvoiceRequest $StoreInnvoiceRequest): \Illuminate\Http\JsonResponse
    {

        // Initialize the data to be saved
        $data = $StoreInnvoiceRequest->except('_token');

        // Check if a file is uploaded
        if ($StoreInnvoiceRequest->hasFile('file_path')) {
            // Get the uploaded file
            $file = $StoreInnvoiceRequest->file('file_path');

            // Generate a unique name for the file before saving it
            $filename = time() . '_' . $file->getClientOriginalName();

            // Move the file to the 'public/uploads/levels' directory
            $filePath = $file->move(public_path('uploads/levels'), $filename);

            // Save the file path to the data array
            $data['file_path'] = 'uploads/levels/' . $filename;
        }

        // Save the invoice data to the database
        $invoice = $this->InnvoiceModel->create($data);

        return $this->responseJson(['type' => 'success', 'message' => ' تم أضافه الأدلة   بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $Innvoice = InnvoiceWeek::find($id) ;
        $Innvoice->delete();
        return  redirect()->back()->with('success'  ,  'تم حذف الدليل  بنجاح') ;

    }

    public function edit($id): \Illuminate\Http\JsonResponse
    {
        $Innvoice = InnvoiceWeek::find($id) ;
        return $this->responseJson(['data' => $Innvoice], Response::HTTP_OK);
    }
    public function update(UpdateInnvoiceRequest $updateInnvoiceRequest, $id ): \Illuminate\Http\RedirectResponse
    {
        $Innvoice = InnvoiceWeek::find($id) ;
        $Innvoice->update($updateInnvoiceRequest->validated());
        return redirect()->route('dashboard.invoices.show' ,$Innvoice->program_id )->with('success', ' تم  تعديل  الأدلة   بنجاح');
    }
}
