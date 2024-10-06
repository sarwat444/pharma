<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Output\StoreWorkSkillRequest;
use App\Http\Requests\Web\Admin\Output\UpdateWorkSkillRequest;
use App\Models\Program;
use App\Models\WorkSkill;
use App\Traits\ResponseJson;
use Symfony\Component\HttpFoundation\Response;

class WorkSkillsController extends Controller
{
    use  ResponseJson ;
    public function __construct(private readonly WorkSkill $WorkSkillModel)
    {}
    public  function  show($program_id =null)
    {
        $program = Program::find($program_id) ;
        $WorkSkills = $this->WorkSkillModel->where('program_id' , $program_id )->get();
        return view('admins.programs.details.workskills.index', compact('WorkSkills' , 'program'));
    }
    public function create(): \Illuminate\View\View
    {
        return view('admins.WorkSkill.create');
    }
    public function store(StoreWorkSkillRequest $StoreWorkSkillRequest): \Illuminate\Http\JsonResponse
    {
        $this->WorkSkillModel->create($StoreWorkSkillRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => ' تم أضافه المهارة بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy($id = null ): \Illuminate\Http\RedirectResponse
    {
        $work_skill = WorkSkill::find($id) ;
        $work_skill->delete();
        return redirect()->route('dashboard.workskills.show' , $work_skill['program_id'])->with('success', ' تم  حذف المهارة  بنجاح');
    }

    public function edit( $id = null ): \Illuminate\Http\JsonResponse
    {
        $WorkSkill = WorkSkill::find($id) ;
        return $this->responseJson(['data' => $WorkSkill], Response::HTTP_OK);
    }
    public function update(UpdateWorkSkillRequest $updateWorkSkillRequest, $id): \Illuminate\Http\RedirectResponse
    {

        $WorkSkill = WorkSkill::find($id) ;
        $WorkSkill->update($updateWorkSkillRequest->validated());
        return redirect()->route('dashboard.workskills.show' ,$WorkSkill['program_id'] )->with('success', ' تم  تعديل  المهارة بنجاح');
    }
}
