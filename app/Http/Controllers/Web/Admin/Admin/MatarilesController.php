<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Output\StoreMatarialRequest;
use App\Http\Requests\Web\Admin\Output\UpdateMatarialRequest;
use App\Models\Matarial;
use App\Models\Program;
use App\Traits\ResponseJson;
use Symfony\Component\HttpFoundation\Response;
use  Illuminate\Support\Facades\Auth ;

class MatarilesController extends Controller
{
    use  ResponseJson ;
    public function __construct(private readonly Matarial $MatarialModel)
    {}
    public  function  show($program_id =null)
    {
        $program = Program::find($program_id) ;
        $matarials = $this->MatarialModel->where('program_id' , $program_id )->get();
        return view('admins.programs.details.matarial.index', compact('matarials' , 'program'));
    }
    public function create(): \Illuminate\View\View
    {
        return view('admins.Matarial.create');
    }
    public function store(StoreMatarialRequest $StoreMatarialRequest): \Illuminate\Http\JsonResponse
    {
        $this->MatarialModel->create($StoreMatarialRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => ' تم أضافه المقرر  بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $matrial = Matarial::find($id) ;
        $matrial->delete();
        return redirect()->route('dashboard.matarials.show' , $matrial['program_id'])->with('success', ' تم  حذف المقرر   بنجاح');
    }

    public function edit($id)
    {
        $mokrrer = Matarial::find($id) ;
        $program = Program::where('id' ,$mokrrer->program_id)->first() ;
        return  view('admins.programs.details.matarial.edit'  , compact('mokrrer' ,'program')) ;
    }
    public function update(UpdateMatarialRequest $updateMatarialRequest, $id ): \Illuminate\Http\RedirectResponse
    {
        $mokrrer = Matarial::find($id) ;
        $mokrrer->update($updateMatarialRequest->validated());
        return  redirect()->back()->with('success' , 'تم التعديل بنجاح') ;
    }
    public  function matarilasType($program_id , $type)
    {
        $program = Program::find($program_id) ;
        $user   = Auth::guard('admin')->user() ;
        if($user->role == 'program_manager')
        {
            $matarials= $this->MatarialModel->where(['program_id' => $program_id , 'type' => $type ])->get();
        }else
        {
            $matarials= $this->MatarialModel->where(['program_id' => $program_id , 'type' => $type ])->where('id' , $user->matrial_id )->get();

        }
        return view('admins.programs.details.matarial.index', compact('matarials' , 'program'));
    }
    public  function input_report($program_id)
    {
      $program = Program::find($program_id) ;
      $matarils  =  Matarial::with('education_output' , 'innvoices' , 'innvoice_weeks')->where('program_id' , $program_id)->get() ;
      return view('admins.programs.details.matarial.report_input' ,compact('matarils', 'program')) ;
    }


}
