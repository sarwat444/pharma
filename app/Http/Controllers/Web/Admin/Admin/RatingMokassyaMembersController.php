<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Dashboard\RatingMokassyaMembers\StoreRatingMokassyaMembersRequest;
use App\Http\Requests\Web\Dashboard\RatingMokassyaMembers\UpdateRatingMokassyaMembersRequest;
use App\Models\College;
use App\Models\MayearMokassy;
use App\Models\Program;
use App\Models\RatingMokassyaMembers;
use App\Traits\ResponseJson;
use Illuminate\Http\Request;

class RatingMokassyaMembersController extends Controller
{
    use ResponseJson;

    public RatingMokassyaMembers $RatingMokassyaMembersModel;

    public function __construct(RatingMokassyaMembers $RatingMokassyaMembersModel)
    {
        $this->RatingMokassyaMembersModel = $RatingMokassyaMembersModel;
    }

    public function index(): \Illuminate\Contracts\View\View
    {
        $RatingMembers = RatingMokassyaMembers::with('college' ,'mayear')->get();
        return view('admins.rating_mokassy_members.index', compact('RatingMembers'));
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        $collegs = College::get();
        $mayears = MayearMokassy::get();
        return view('admins.rating_mokassy_members.new-user', compact('collegs', 'mayears'));
    }

    public function store(StoreRatingMokassyaMembersRequest $storeRatingMokassyaMembersRequest): \Illuminate\Http\RedirectResponse
    {
        $validated = $storeRatingMokassyaMembersRequest->validated();
        $validated['password'] = bcrypt($validated['password']);
        $this->RatingMokassyaMembersModel->create($validated);
        return redirect()->back()->with('success', 'تم أضافه المحكم  بنجاح');
    }

    public function edit($id)
    {
        $collegs = College::get();
        $mayears = MayearMokassy::get();
        $admin = RatingMokassyaMembers::find($id);
        return view('admins.rating_mokassy_members.edit-user', compact('collegs', 'mayears', 'admin'));
    }

    public function update(UpdateRatingMokassyaMembersRequest $updateRatingMokassyaMembersRequest, RatingMokassyaMembers $RatingMokassyaMembers): \Illuminate\Http\RedirectResponse
    {
        $validated = $updateRatingMokassyaMembersRequest->validated();
        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }
        $RatingMokassyaMembers->update($validated);
        return redirect()->back()->with('success', 'تم تعديل  بيانات المدير بنجاح ');
    }

    public function destroy($id, Request $request)
    {
        RatingMokassyaMembers::find($id)->delete();
        return redirect()->back()->with('success', 'تم حذف العضو بنجاح');
    }
    public function getMayaears($college_id)
    {
        $mayaears = MayearMokassy::where('college_id', $college_id)->get();
        return response()->json($mayaears);
    }
}
