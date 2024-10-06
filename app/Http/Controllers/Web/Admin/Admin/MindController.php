<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Output\StoreMindRequest;
use App\Http\Requests\Web\Admin\Output\UpdateMindRequest;
use App\Models\Mind;
use App\Models\Program;
use App\Traits\ResponseJson;
use Symfony\Component\HttpFoundation\Response;

class MindController extends Controller
{
    use  ResponseJson ;
    public function __construct(private readonly Mind $MindModel)
    {}
    public  function  show($program_id =null)
    {
        $program = Program::find($program_id) ;
        $minds = $this->MindModel->where('program_id' , $program_id )->get();
        return view('admins.programs.details.mind.index', compact('minds' , 'program'));
    }
    public function create(): \Illuminate\View\View
    {
        return view('admins.mind.create');
    }
    public function store(StoreMindRequest $StoreMindRequest): \Illuminate\Http\JsonResponse
    {
        $this->MindModel->create($StoreMindRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => ' تم أضافه القدره الذهنية بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy(Mind $Mind): \Illuminate\Http\RedirectResponse
    {
        $Mind->delete();
        return redirect()->route('dashboard.mind.show' , $Mind['program_id'])->with('success', ' تم  حذف القدره الذهنية  بنجاح');
    }

    public function edit(Mind $Mind): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson(['data' => $Mind], Response::HTTP_OK);
    }
    public function update(UpdateMindRequest $updateMindRequest, Mind $Mind): \Illuminate\Http\RedirectResponse
    {
        $Mind->update($updateMindRequest->validated());
        return redirect()->route('dashboard.mind.show' ,$Mind->program_id )->with('success', ' تم  تعديل  القدره الذهنية بنجاح');
    }
}
