<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Output\StoreKnowledgeRequest;
use App\Http\Requests\Web\Admin\Output\UpdateKnowledgeRequest;
use App\Models\{Knowledge, Program};
use App\Traits\ResponseJson;
use Symfony\Component\HttpFoundation\Response;

class KnowledgeController extends Controller
{
    use  ResponseJson ;
    public function __construct(private readonly Knowledge $KnowledgeModel)
    {}
    public  function  show($program_id =null)
    {
        $program = Program::find($program_id) ;
        $Knowledges = $this->KnowledgeModel->where('program_id' , $program_id )->get();
        return view('admins.programs.details.Knowledge.index', compact('Knowledges' , 'program'));
    }
    public function create(): \Illuminate\View\View
    {
        return view('admins.Knowledge.create');
    }
    public function store(StoreKnowledgeRequest $StoreKnowledgeRequest): \Illuminate\Http\JsonResponse
    {
        $this->KnowledgeModel->create($StoreKnowledgeRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => ' تم أضافه المعرفة بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy(Knowledge $Knowledge): \Illuminate\Http\RedirectResponse
    {
        $Knowledge->delete();
        return redirect()->route('dashboard.Knowledge.show' , $Knowledge['program_id'])->with('success', ' تم  حذف المعرفة  بنجاح');
    }

    public function edit(Knowledge $Knowledge): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson(['data' => $Knowledge], Response::HTTP_OK);
    }
    public function update(UpdateKnowledgeRequest $updateKnowledgeRequest, Knowledge $Knowledge): \Illuminate\Http\RedirectResponse
    {
        $Knowledge->update($updateKnowledgeRequest->validated());
        return redirect()->route('dashboard.Knowledge.show' ,$Knowledge->program_id )->with('success', ' تم  تعديل  المعرفة بنجاح');
    }
}
