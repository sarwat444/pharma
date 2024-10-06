<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\{MayearMokassy , College };
use App\Traits\ResponseJson;
use Illuminate\Http\Request;
use App\Http\Requests\Web\Admin\MayearMokassy\StoreMayearMokassyRequest ;
use App\Http\Requests\Web\Admin\MayearMokassy\UpdateMayearMokassyRequest ;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
class MayearMokassyController extends Controller
{
    use ResponseJson;

    public function __construct(private readonly MayearMokassy $MayearMokassyModel){}

    public function show($college_id): \Illuminate\View\View
    {
        $college = College::find($college_id);
        $myears = $this->MayearMokassyModel->withCount('mokashers')->where('college_id' , $college_id)->get();
        return view('admins.mayear_mokassy.index', compact('myears' ,'college'));
    }

    public function create(): \Illuminate\View\View
    {
        return view('admins.mayear_mokassy.create');
    }

    public function   store(StoreMayearMokassyRequest $storeMayearMokassyRequest): \Illuminate\Http\JsonResponse
    {
        $this->MayearMokassyModel->create($storeMayearMokassyRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => 'تم أضافه المعيار المؤسسي بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy(MayearMokassy $MayearMokassy): \Illuminate\Http\RedirectResponse
    {
        $MayearMokassy->delete();
        return redirect()->back()->with('success', 'تم حذف المعيار المؤسسي بنجاح');
    }

    public function edit($id): \Illuminate\Http\JsonResponse
    {
        $MayearMokassy  = MayearMokassy::find($id) ;
        return $this->responseJson(['data' => $MayearMokassy], Response::HTTP_OK);
    }

    public function update(UpdateMayearMokassyRequest $updateMayearMokassyRequest, $id): \Illuminate\Http\RedirectResponse
    {
        $MayearMokassy  = MayearMokassy::find($id) ;
        $MayearMokassy->update($updateMayearMokassyRequest->validated());
        return redirect()->back()->with('success', 'تم تعديل المعيار المؤسسي بنجاح');
    }
    public function mayear_rating_report($college_id)
    {
        $college = Program::with('mayears.mokashers.momarsat.rating_momarsa')->find($college_id);

        // Create an array to store percentages for each mayer
        $mayerPercentages = [];

        foreach ($college->mayears as $mayer) {
            $totalRate = 0;
            $totalMomarsat = 0;

            foreach ($mayer->mokashers as $mokasher) {
                foreach ($mokasher->momarsat as $momarsa) {
                    if ($momarsa->rating_momarsa) {
                        // Add the rate to the total rate
                        $totalRate += $momarsa->rating_momarsa->rate;
                        $totalMomarsat++;
                    }
                }

            }
            // Calculate the percentage for this mayer
            $mayerPercentages[$mayer->id] = $totalMomarsat > 0 ? ($totalRate / $totalMomarsat) : 0;
        }

        // Pass the calculated percentages and the program object to the view
        return view('admins.mayear_mokassy.report', compact('program', 'mayerPercentages'));
    }

}
