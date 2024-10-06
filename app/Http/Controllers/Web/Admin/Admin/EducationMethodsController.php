<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Output\StoreEductionMethodRequest;
use App\Http\Requests\Web\Admin\Output\UpdateEductionMethodRequest;
use App\Models\EductionMethod;
use App\Models\EductionMethodWeek;
use App\Traits\ResponseJson;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\Response;

class EducationMethodsController extends Controller
{
    use  ResponseJson ;
    public function __construct(private readonly EductionMethod $EductionMethodModel)
    {}
    public function store(StoreEductionMethodRequest $StoreEductionMethodRequest): \Illuminate\Http\JsonResponse
    {
        $this->EductionMethodModel->create($StoreEductionMethodRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => ' تم أضافه الناتج  بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy($id = null): \Illuminate\Http\RedirectResponse
    {
        $output = EductionMethod::where('id' ,$id)->first() ;
        $output->delete();
        return redirect()->route('dashboard.matarials.matraialmap_content' , ['matarial_id' => $output->matarial_id , 'week_id' =>  $output->week_number  ,'active' => 3 ]);
    }

    public function edit(EductionMethod $EductionMethod): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson(['data' => $EductionMethod], Response::HTTP_OK);
    }
    public function update(UpdateEductionMethodRequest $updateEductionMethodRequest, EductionMethod $EductionMethod): \Illuminate\Http\RedirectResponse
    {
        $EductionMethod->update($updateEductionMethodRequest->validated());
        return redirect()->route('dashboard.EductionMethod.show' ,$EductionMethod->program_id )->with('success', ' تم  تعديل  الهدف بنجاح');
    }
    public function change_eduction_methods_active(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = Request::input('id');

        $method = EductionMethod::find($id);

        if ($method) {
            $method->active = !$method->active;
            $method->save();

            return response()->json(['type' => 'success', 'message' => 'تم التعديل بنجاح'], \Illuminate\Http\Response::HTTP_OK);
        } else {
            return response()->json(['type' => 'error', 'message' => 'الطريقة غير موجودة'], \Illuminate\Http\Response::HTTP_NOT_FOUND);
        }
    }


    public function change_eduction_methods_active2(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = Request::input('id');

        $method = EductionMethodWeek::find($id);

        if ($method) {
            $method->active = !$method->active;
            $method->save();

            return response()->json(['type' => 'success', 'message' => 'تم التعديل بنجاح'], \Illuminate\Http\Response::HTTP_OK);
        } else {
            return response()->json(['type' => 'error', 'message' => 'الطريقة غير موجودة'], \Illuminate\Http\Response::HTTP_NOT_FOUND);
        }
    }



}
