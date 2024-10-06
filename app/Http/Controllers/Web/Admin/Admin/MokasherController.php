<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\mokashers\StoreMokasherRequest;
use App\Http\Requests\Web\Admin\mokashers\UpdateMokasherRequest;
use App\Http\Requests\Web\Admin\users\StoremokasharatInputs;
use App\Models\Mokasher;
use App\Models\Myear;
use App\Models\Program;
use App\Models\User;
use App\Traits\ResponseJson;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class MokasherController extends Controller
{
    use ResponseJson;

    public function __construct(private readonly Mokasher $mokasherModel)
    {
    }

    public function show($mayer_id = null): View
    {
        $mayer = Myear::with('program')->find($mayer_id);
        $program  = $mayer->program ;
        $mokashert = $this->mokasherModel->where('myear_id', $mayer_id)->get();
        return view('admins.moksherat.index', compact('mokashert', 'mayer' , 'program'));
    }

    public function create(): View
    {
        return view('admins.moksherat.create');
    }

    public function store(StoreMokasherRequest $StoreMokasherRequest): JsonResponse
    {
        $this->mokasherModel->create($StoreMokasherRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => 'تم أضافه المؤشر بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy($mokasher_id = null): RedirectResponse
    {
        $found_mokaser = Mokasher::find($mokasher_id);
        $found_mokaser->delete();
        return redirect()->back()->with('success', ' تم  حذف المؤشر  بنجاح');
    }
    public function edit($id = null)
    {
        $mokasher = Mokasher::find($id);
        return $this->responseJson(['data' => $mokasher], Response::HTTP_OK);
    }

    public function update(UpdateMokasherRequest $UpdateMokasherRequest  , $id): RedirectResponse
    {
        $mokasher = Mokasher::find($id);
        $mokasher->update($UpdateMokasherRequest->validated());
        return redirect()->back()->with('success', ' تم  تعديل  المؤشر بنجاح');
    }
}
