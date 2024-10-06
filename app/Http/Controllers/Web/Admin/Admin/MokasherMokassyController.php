<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\MokasherMokassys\StoreMokasherMokassyRequest;
use App\Http\Requests\Web\Admin\MokasherMokassys\UpdateMokasherMokassyRequest;
use App\Models\MokasherMokassy;
use App\Models\MayearMokassy;
use App\Traits\ResponseJson;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class MokasherMokassyController extends Controller
{
    use ResponseJson;

    public function __construct(private readonly MokasherMokassy $MokasherMokassyModel)
    {
    }

    public function show($mayer_id = null): View
    {
        $mayer = MayearMokassy::find($mayer_id);
        $mokashert   = $this->MokasherMokassyModel->where('mayear_mokassy_id', $mayer_id)->get();
        return view('admins.mokasherat_mokassy.index', compact('mokashert', 'mayer'));
    }
    public function create(): View
    {
        return view('admins.momarsat_mokassya.create');
    }

    public function store(StoreMokasherMokassyRequest $StoreMokasherMokassyRequest): JsonResponse
    {
        $this->MokasherMokassyModel->create($StoreMokasherMokassyRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => 'تم أضافه المؤشر بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy($MokasherMokassy_id = null): RedirectResponse
    {
        $found_mokaser = MokasherMokassy::find($MokasherMokassy_id);
        $found_mokaser->delete();
        return redirect()->back()->with('success', ' تم  حذف المؤشر  بنجاح');
    }
    public function edit($id = null)
    {
        $MokasherMokassy = MokasherMokassy::find($id);
        return $this->responseJson(['data' => $MokasherMokassy], Response::HTTP_OK);
    }

    public function update(UpdateMokasherMokassyRequest $UpdateMokasherMokassyRequest  , $id): RedirectResponse
    {
        $MokasherMokassy = MokasherMokassy::find($id);
        $MokasherMokassy->update($UpdateMokasherMokassyRequest->validated());
        return redirect()->back()->with('success', ' تم  تعديل  المؤشر بنجاح');
    }
}
