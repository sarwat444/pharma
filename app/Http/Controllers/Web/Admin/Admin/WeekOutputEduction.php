<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Output\StoreTeachingOutputRequest;
use App\Http\Requests\Web\Admin\Output\UpdateTeachingOutputRequest;
use App\Models\Program;
use App\Models\TeachingOutputWeek;
use App\Traits\ResponseJson;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WeekOutputEduction extends Controller
{
    use  ResponseJson ;
    public function __construct(private readonly TeachingOutputWeek $TeachingOutputModel)
    {}
    public  function  show($program_id =null)
    {
        $program = Program::find($program_id) ;
        $TeachingOutputs = $this->TeachingOutputModel->where('program_id' , $program_id )->get();
        return view('admins.programs.details.TeachingOutput.index', compact('TeachingOutputs' , 'program'));
    }
    public function create(): \Illuminate\View\View
    {
        return view('admins.TeachingOutput.create');
    }
    public function store(StoreTeachingOutputRequest $StoreTeachingOutputRequest): \Illuminate\Http\JsonResponse
    {
        $this->TeachingOutputModel->create($StoreTeachingOutputRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => ' تم أضافه الناتج  بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy($id = null): \Illuminate\Http\RedirectResponse
    {
        $output = TeachingOutputWeek::where('id' ,$id)->first();
        $output->delete();
        return redirect()->route('dashboard.matarials.weekreport_content' , ['matarial_id' => $output->matarial_id , 'week_id' =>  $output->week_number , 'active' => 1 ]);


    }

    public function edit(TeachingOutputWeek $TeachingOutput): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson(['data' => $TeachingOutput], Response::HTTP_OK);
    }
    public function update(UpdateTeachingOutputRequest $updateTeachingOutputRequest, TeachingOutputWeek $TeachingOutput): \Illuminate\Http\RedirectResponse
    {
        $TeachingOutput->update($updateTeachingOutputRequest->validated());
        return redirect()->route('dashboard.TeachingOutput.show' ,$TeachingOutput->program_id )->with('success', ' تم  تعديل  الهدف بنجاح');
    }
}
