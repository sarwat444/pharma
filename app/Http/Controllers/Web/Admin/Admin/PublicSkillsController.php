<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Output\StorePublicSkillRequest;
use App\Http\Requests\Web\Admin\Output\UpdatePublicSkillRequest;
use App\Models\Program;
use App\Models\PublicSkill;
use App\Traits\ResponseJson;
use Symfony\Component\HttpFoundation\Response;

class PublicSkillsController extends Controller
{
    use  ResponseJson ;
    public function __construct(private readonly PublicSkill $PublicSkillModel)
    {}
    public  function  show($program_id =null)
    {
        $program = Program::find($program_id) ;
        $PublicSkills = $this->PublicSkillModel->where('program_id' , $program_id )->get();
        return view('admins.programs.details.publicskills.index', compact('PublicSkills' , 'program'));
    }
    public function create(): \Illuminate\View\View
    {
        return view('admins.PublicSkill.create');
    }
    public function store(StorePublicSkillRequest $StorePublicSkillRequest): \Illuminate\Http\JsonResponse
    {
        $this->PublicSkillModel->create($StorePublicSkillRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => ' تم أضافه المهارة بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy($id = null  ): \Illuminate\Http\RedirectResponse
    {
        $PublicSkill = PublicSkill::find($id) ;
        $PublicSkill->delete();
        return redirect()->route('dashboard.publicSkills.show' , $PublicSkill['program_id'])->with('success', ' تم  حذف المهارة  بنجاح');
    }

    public function edit($id ): \Illuminate\Http\JsonResponse
    {
        $PublicSkill = PublicSkill::find($id) ;
        return $this->responseJson(['data' => $PublicSkill], Response::HTTP_OK);
    }
    public function update(UpdatePublicSkillRequest $updatePublicSkillRequest, $id): \Illuminate\Http\RedirectResponse
    {
        $PublicSkill = PublicSkill::find($id) ;
        $PublicSkill->update($updatePublicSkillRequest->validated());
        return redirect()->route('dashboard.publicSkills.show' ,$PublicSkill['program_id'] )->with('success', ' تم  تعديل  المهارة بنجاح');
    }
}
