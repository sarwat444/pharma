<?php

namespace App\Http\Controllers\web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Momarsas\StoreMomarsaRequest;
use App\Http\Requests\Web\Admin\Momarsas\UpdateMomarsaRequest;
use App\Models\Mokasher;
use App\Models\Momarsa;
use App\Traits\ResponseJson;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MomarsaController extends Controller
{
    use ResponseJson;

    public function __construct(private readonly Momarsa $MomarsaModel){}

    public function show($mokasher_id): \Illuminate\View\View
    {
        $mokasher = Mokasher::with('mayer' , 'mayer.program')->find($mokasher_id);
        $program = $mokasher->mayer->program ;
        $Momarsas = $this->MomarsaModel->withCount('files')->where('mokasher_id' , $mokasher_id)->get();
        return view('admins.momarsat.index', compact('Momarsas' , 'mokasher' ,'program'));
    }

    public function create(): \Illuminate\View\View
    {
        return view('admins.momarsat.create');
    }

    public function store(StoreMomarsaRequest $storeMomarsaRequest): \Illuminate\Http\JsonResponse
    {
        $this->MomarsaModel->create($storeMomarsaRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => 'تم أضافة الممارسة بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy($Id ): \Illuminate\Http\RedirectResponse
    {
        $Momarsa  = Momarsa::find($Id) ;
        $Momarsa->delete();
        return redirect()->back()->with('success', 'تم حذف الممارسة بنجاح ');
    }

    public function edit($id): \Illuminate\Http\JsonResponse
    {
        $Momarsa  = Momarsa::find($id) ;
        return $this->responseJson(['data' => $Momarsa], Response::HTTP_OK);
    }

    public function update(UpdateMomarsaRequest $updateMomarsaRequest, $id): \Illuminate\Http\RedirectResponse
    {
        $Momarsa  = Momarsa::find($id) ;
        $Momarsa->update($updateMomarsaRequest->validated());
        return redirect()->back()->with('success', 'تم تعديل الممارسة بنجاح');
    }

}
