<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Goals\StoreGoolRequest;
use App\Http\Requests\Web\Admin\Goals\UpdateGoolRequest;
use App\Models\{Goal, Program};
use App\Models\Objective;
use App\Traits\ResponseJson;
use Symfony\Component\HttpFoundation\Response;

class GoalController extends Controller
{
    use ResponseJson ;
    public function __construct(private readonly Goal $goalModel)
    {}
    public  function  show($program_id =null)
    {
        $program = Program::find($program_id) ;
        $goals = $this->goalModel->where('program_id' , $program_id )->get();
        return view('admins.programs.details.goals.index', compact('goals' , 'program'));
    }
    public function create(): \Illuminate\View\View
    {
        return view('admins.goals.create');
    }
    public function store(StoreGoolRequest $storeGoolRequest): \Illuminate\Http\JsonResponse
    {
        $this->goalModel->create($storeGoolRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => ' تم أضافه الهدف بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy(Goal $goal): \Illuminate\Http\RedirectResponse
    {
        $goal->delete();
        return redirect()->route('dashboard.goals.show' , $goal['program_id'])->with('success', ' تم  حذف الهدف  بنجاح');
    }

    public function edit(Goal $goal): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson(['data' => $goal], Response::HTTP_OK);
    }
    public function update(UpdateGoolRequest $updateGoalRequest, Goal $goal): \Illuminate\Http\RedirectResponse
    {
        $goal->update($updateGoalRequest->validated());
        return redirect()->route('dashboard.goals.show' ,$goal->program_id )->with('success', ' تم  تعديل  الهدف بنجاح');
    }
}
