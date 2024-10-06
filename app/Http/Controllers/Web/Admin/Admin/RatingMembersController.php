<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Dashboard\RatingMembers\StoreRatingMembersRequest;
use App\Http\Requests\Web\Dashboard\RatingMembers\UpdateRatingMembersRequest;
use App\Models\RatingMembers;
use App\Models\College;
use App\Models\Program;
use App\Models\User;
use App\Traits\ResponseJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RatingMembersController extends Controller
{
    use ResponseJson;

    public RatingMembers $RatingMembersModel;

    public function __construct(RatingMembers $RatingMembersModel)
    {
        $this->RatingMembersModel = $RatingMembersModel;
    }

    public function index(): \Illuminate\Contracts\View\View
    {
        $RatingMembers = RatingMembers::with('college')->get();
        return view('admins.rating_members.index', compact('RatingMembers'));
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        $collegs = College::get();
        $programs = Program::get();
        return view('admins.rating_members.new-user', compact('collegs', 'programs'));
    }

    public function store(StoreRatingMembersRequest $storeRatingMembersRequest): \Illuminate\Http\RedirectResponse
    {
        $validated = $storeRatingMembersRequest->validated();
        $validated['password'] = bcrypt($validated['password']);
        $this->RatingMembersModel->create($validated);
        return redirect()->back()->with('success', 'تم أضافه المحكم  بنجاح');
    }

    public function edit($id)
    {
        $collegs = College::get();
        $programs = Program::get();
        $admin = RatingMembers::find($id);
        return view('admins.rating_members.edit-user', compact('collegs', 'programs', 'admin'));
    }

    public function update(UpdateRatingMembersRequest $updateRatingMembersRequest, RatingMembers $RatingMembers): \Illuminate\Http\RedirectResponse
    {
        $validated = $updateRatingMembersRequest->validated();
        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }
        $RatingMembers->update($validated);
        return redirect()->back()->with('success', 'تم تعديل  بيانات المدير بنجاح ');
    }

    public function destroy($id, Request $request)
    {
        RatingMembers::find($id)->delete();
        return redirect()->back()->with('success', 'تم حذف العضو بنجاح');
    }
}
