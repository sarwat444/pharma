<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\MomarsaMokassyas\StoreMomarsaMokassyaRequest;
use App\Http\Requests\Web\Admin\MomarsaMokassyas\UpdateMomarsaMokassyaRequest;
use App\Models\MokasherMokassy;
use App\Models\MomarsaMokassya;
use App\Traits\ResponseJson;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MomarsatMokassyaController extends Controller
{
    use ResponseJson;

    public function __construct(private readonly MomarsaMokassya $MomarsaMokassyaModel){}

    public function show($mokasher_id): \Illuminate\View\View
    {
        $mokasher = MokasherMokassy::with('mayer')->find($mokasher_id);
        $Momarsas = $this->MomarsaMokassyaModel->withCount('files')->where('mokasher_id' , $mokasher_id)->get();
        return view('admins.momarsat_mokassya.index', compact('Momarsas' , 'mokasher'));
    }

    public function create(): \Illuminate\View\View
    {
        return view('admins.momarsat_mokassya.create');
    }

    public function store(StoreMomarsaMokassyaRequest $storeMomarsaMokassyaRequest): \Illuminate\Http\JsonResponse
    {
        $this->MomarsaMokassyaModel->create($storeMomarsaMokassyaRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => 'تم أضافة الممارسة بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy($Id ): \Illuminate\Http\RedirectResponse
    {
        $MomarsaMokassya  = MomarsaMokassya::find($Id) ;
        $MomarsaMokassya->delete();
        return redirect()->back()->with('success', 'تم حذف الممارسة بنجاح ');
    }

    public function edit($id): \Illuminate\Http\JsonResponse
    {
        $MomarsaMokassya  = MomarsaMokassya::find($id) ;
        return $this->responseJson(['data' => $MomarsaMokassya], Response::HTTP_OK);
    }

    public function update(UpdateMomarsaMokassyaRequest $updateMomarsaMokassyaRequest, $id): \Illuminate\Http\RedirectResponse
    {
        $MomarsaMokassya  = MomarsaMokassya::find($id) ;
        $MomarsaMokassya->update($updateMomarsaMokassyaRequest->validated());
        return redirect()->back()->with('success', 'تم تعديل الممارسة بنجاح');
    }

}
