<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Myears\StoreMyearRequest;
use App\Http\Requests\Web\Admin\Myears\UpdateMyearRequest;
use App\Models\Myear;
use App\Models\Program;
use App\Traits\ResponseJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MyearController extends Controller
{
    use ResponseJson;

    public function __construct(private readonly Myear $MyearModel){}

    public function show($program_id): \Illuminate\View\View
    {
        $program = Program::find($program_id);
        $myears = $this->MyearModel->withCount('mokashers')->where('program_id' , $program_id)->get();
        return view('admins.mayers.index', compact('myears' ,'program'));
    }

    public function create(): \Illuminate\View\View
    {
        return view('admins.mayers.create');
    }

    public function   store(StoreMyearRequest $storeMyearRequest): \Illuminate\Http\JsonResponse
    {
        $this->MyearModel->create($storeMyearRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => 'Myear created successfully.'], Response::HTTP_CREATED);
    }

    public function destroy(Myear $Myear): \Illuminate\Http\RedirectResponse
    {
        $Myear->delete();
        return redirect()->back()->with('success', 'Myear deleted successfully');
    }

    public function edit($id): \Illuminate\Http\JsonResponse
    {
        $Myear  = Myear::find($id) ;
        return $this->responseJson(['data' => $Myear], Response::HTTP_OK);
    }

    public function update(UpdateMyearRequest $updateMyearRequest, $id): \Illuminate\Http\RedirectResponse
    {
        $Myear  = Myear::find($id) ;
        $Myear->update($updateMyearRequest->validated());
        return redirect()->back()->with('success', 'Myear updated successfully');
    }
    public function mayear_rating_report($program_id)
    {
        $program = Program::with('mayears.mokashers.momarsat.rating_momarsa')->find($program_id);

        // Create an array to store percentages for each mayer
        $mayerPercentages = [];

        foreach ($program->mayears as $mayer) {
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
        return view('admins.mayers.report', compact('program', 'mayerPercentages'));
    }

    public function mayear_rating_files_report($program_id)
    {
        $program = Program::with('mayears.mokashers.momarsat.files')->find($program_id);

        // Create an array to store percentages for each mayer
        $mayerPercentages = [];

        foreach ($program->mayears as $mayer) {
            $totalFiles = 0;
            $totalMomarsat = 0;
            $expectedFilesPerMomarsa = 2; // Number of files expected per practice

            foreach ($mayer->mokashers as $mokasher) {
                foreach ($mokasher->momarsat as $momarsa) {
                    $totalMomarsat += 1; // Count each practice
                    if ($momarsa->files->count() > 0) {
                        $totalFiles += $momarsa->files->count();
                    }
                }
            }

            // Calculate the expected number of files
            $expectedFiles = $totalMomarsat * $expectedFilesPerMomarsa;

            // Calculate the percentage for this mayer
            $mayerPercentages[$mayer->id] = $expectedFiles > 0 ? ($totalFiles / $expectedFiles) * 100 : 0;
        }

        // Pass the calculated percentages and the program object to the view
        return view('admins.mayers.report_files', compact('program', 'mayerPercentages'));
    }


}
