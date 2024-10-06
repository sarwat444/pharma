<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Output\StoreStandardRequest;
use App\Http\Requests\Web\Admin\Output\UpdateStandardRequest;
use App\Models\Program;
use App\Models\Standard;
use App\Traits\ResponseJson;
use Symfony\Component\HttpFoundation\Response;

class StandardsController extends Controller
{
    use  ResponseJson ;
    public function __construct(private readonly Standard $StandardModel)
    {}
    public  function  show($program_id =null)
    {
        $program = Program::find($program_id) ;
        $standers = $this->StandardModel->where('program_id' , $program_id )->get();
        return view('admins.programs.details.standers.index', compact('standers' , 'program'));
    }
    public function create(): \Illuminate\View\View
    {
        return view('admins.standers.create');
    }
    public function store(StoreStandardRequest $StoreStandardRequest): \Illuminate\Http\JsonResponse
    {
        $this->StandardModel->create($StoreStandardRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => ' تم أضافه المعايير الأكاديمية   بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $Standard = Standard::find($id) ;
        $Standard->delete();
        return redirect()->route('dashboard.standers.show' , $Standard['program_id'])->with('success', ' تم  حذف المعايير الأكاديمية  بنجاح');
    }

    public function edit($id): \Illuminate\Http\JsonResponse
    {
        $Standard = Standard::find($id) ;
        return $this->responseJson(['data' => $Standard], Response::HTTP_OK);
    }
    public function update(UpdateStandardRequest $updateStandardRequest, $id ): \Illuminate\Http\RedirectResponse
    {
        $Standard = Standard::find($id) ;
        $Standard->update($updateStandardRequest->validated());
        return redirect()->route('dashboard.standers.show' ,$Standard->program_id )->with('success', ' تم  تعديل  المعايير الأكاديمية   بنجاح');
    }
}
