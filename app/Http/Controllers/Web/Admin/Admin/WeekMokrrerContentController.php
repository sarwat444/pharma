<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Output\StoreMokrrerContentRequest;
use App\Http\Requests\Web\Admin\Output\UpdateMokrrerContentRequest;
use App\Models\MokrrerContentWeek;
use App\Traits\ResponseJson;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WeekMokrrerContentController extends Controller
{
    use  ResponseJson ;
    public function __construct(private readonly MokrrerContentWeek $MokrrerContentModel)
    {}
    public function store(StoreMokrrerContentRequest $StoreMokrrerContentRequest): \Illuminate\Http\JsonResponse
    {
        $this->MokrrerContentModel->create($StoreMokrrerContentRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => ' تم أضافه الناتج   بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy($id = null): \Illuminate\Http\RedirectResponse
    {
        $output = MokrrerContentWeek::where('id' ,$id)->first() ;
        $output->delete();
        return redirect()->route('dashboard.matarials.weekreport_content' , ['matarial_id' => $output->matarial_id , 'week_id' =>  $output->week_number  , 'active' => 2 ]);
    }

    public function edit(MokrrerContentWeek $MokrrerContent): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson(['data' => $MokrrerContent], Response::HTTP_OK);
    }
    public function update(UpdateMokrrerContentRequest $updateMokrrerContentRequest, MokrrerContentWeek $MokrrerContent): \Illuminate\Http\RedirectResponse
    {
        $MokrrerContent->update($updateMokrrerContentRequest->validated());
        return redirect()->route('dashboard.MokrrerContent.show' ,$MokrrerContent->program_id )->with('success', ' تم  تعديل  الهدف بنجاح');
    }
}
