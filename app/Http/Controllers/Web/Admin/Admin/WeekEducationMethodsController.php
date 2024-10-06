<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Output\StoreEductionMethodRequest;
use App\Http\Requests\Web\Admin\Output\UpdateEductionMethodRequest;
use App\Models\EductionMethodWeek;
use App\Traits\ResponseJson;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WeekEducationMethodsController extends Controller
{
    use  ResponseJson ;
    public function __construct(private readonly EductionMethodWeek $EductionMethodModel)
    {}
    public function store(StoreEductionMethodRequest $StoreEductionMethodRequest): \Illuminate\Http\JsonResponse
    {
        $this->EductionMethodModel->create($StoreEductionMethodRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => ' تم أضافه الناتج  بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy($id = null): \Illuminate\Http\RedirectResponse
    {
        $output = EductionMethodWeek::where('id' ,$id)->first() ;
        $output->delete();
        return  redirect()->back()->with('success' , 'تم الحذف  بنجاح')  ;
    }

    public function edit(EductionMethodWeek $EductionMethod): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson(['data' => $EductionMethod], Response::HTTP_OK);
    }
    public function update(UpdateEductionMethodRequest $updateEductionMethodRequest, EductionMethodWeek $EductionMethod): \Illuminate\Http\RedirectResponse
    {
        $EductionMethod->update($updateEductionMethodRequest->validated());
        return redirect()->route('dashboard.EductionMethod.show' ,$EductionMethod->program_id )->with('success', ' تم  تعديل  الهدف بنجاح');
    }
}
