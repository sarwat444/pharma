<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Output\StoreeductionMapRequest;
use App\Http\Requests\Web\Admin\Output\StoreTeachingOutputRequest;
use App\Http\Requests\Web\Admin\Output\UpdateTeachingOutputRequest;
use App\Models\EductionOutputMap;
use App\Models\Matarial;
use App\Models\Program;
use App\Models\TeachingOutput;
use App\Traits\ResponseJson;
use Symfony\Component\HttpFoundation\Response;

class OutputEduction extends Controller
{
    use  ResponseJson ;
    public function __construct(private readonly TeachingOutput $TeachingOutputModel)
    {}
    public function output_type($matarial_id =null , $type = null )
    {
        $matarial = Matarial::find($matarial_id) ;
        $eduction_outputs = $this->TeachingOutputModel->where(['matarial_id' => $matarial_id , 'type' => $type ])->get();
        return view('admins.eduction_output.index', compact('eduction_outputs' , 'matarial' ,'type'));
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
        $output = TeachingOutput::where('id' ,$id)->first() ;
        $output->delete();
        return redirect()->route('dashboard.output_eduction.type' , ['matarial_id' => $output->matarial_id , 'type' => $output->type ]);
    }

    public function edit($id = null ): \Illuminate\Http\JsonResponse
    {
        $TeachingOutput = TeachingOutput::where('id' ,$id)->first() ;
        return $this->responseJson(['data' => $TeachingOutput], Response::HTTP_OK);
    }
    public function update(UpdateTeachingOutputRequest $updateTeachingOutputRequest, $id =null ): \Illuminate\Http\RedirectResponse
    {
        $TeachingOutput = TeachingOutput::where('id' ,$id)->first() ;
        $TeachingOutput->update($updateTeachingOutputRequest->validated());
        return redirect()->back()->with('success', ' تم  تعديل  الهدف بنجاح');
    }

    //تخزين  نواتج التعلم داخل  خريطه المنهج
      public function store_map(StoreeductionMapRequest $request): \Illuminate\Http\JsonResponse
      {
          EductionOutputMap::create($request->validated()) ;
          return $this->responseJson(['type' => 'success', 'message' => ' تم أضافه الناتج  بنجاح'], Response::HTTP_CREATED);
      }

      // حذف  نتايج  التعلم  فى  خريطه المنهج
       public  function destroy_output_education($id)
       {
           $output  = EductionOutputMap::find($id) ;
           $output->delete() ;
            return redirect()->back()->with('success' , 'لقد  تم  حذف  الناتج بنجاح') ;

       }


}
