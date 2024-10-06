<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Output\StoreReferenceRequest;
use App\Http\Requests\Web\Admin\Output\UpdateReferenceRequest;
use App\Models\Program;
use App\Models\Reference;
use App\Traits\ResponseJson;
use Symfony\Component\HttpFoundation\Response;

class ReferenceController extends Controller
{
    use  ResponseJson ;
    public function __construct(private readonly Reference $ReferenceModel)
    {}
    public  function  show($program_id =null)
    {
        $program = Program::find($program_id) ;
        $references = $this->ReferenceModel->where('program_id' , $program_id )->get();
        return view('admins.programs.details.references.index', compact('references' , 'program'));
    }
    public function create(): \Illuminate\View\View
    {
        return view('admins.references.create');
    }
    public function store(StoreReferenceRequest $StoreReferenceRequest): \Illuminate\Http\JsonResponse
    {
        $this->ReferenceModel->create($StoreReferenceRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => ' تم أضافه العلامة المرجعية  بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $Reference = Reference::find($id) ;
        $Reference->delete();
        return redirect()->route('dashboard.references.show' , $Reference['program_id'])->with('success', ' تم  حذف العلامة المرجعية   بنجاح');
    }

    public function edit($id): \Illuminate\Http\JsonResponse
    {
        $Reference = Reference::find($id) ;
        return $this->responseJson(['data' => $Reference], Response::HTTP_OK);
    }
    public function update(UpdateReferenceRequest $updateReferenceRequest, $id): \Illuminate\Http\RedirectResponse
    {
        $Reference = Reference::find($id) ;
        $Reference->update($updateReferenceRequest->validated());
        return redirect()->route('dashboard.references.show' ,$Reference->program_id )->with('success', ' تم  تعديل  العلامة المرجعية  بنجاح');
    }
}
