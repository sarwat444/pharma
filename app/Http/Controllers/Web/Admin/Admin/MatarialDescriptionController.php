<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Output\StoreMatarialDescriptionRequest;
use App\Http\Requests\Web\Admin\Output\UpdateMatarialDescriptionRequest;
use App\Models\{Matarial, MatarialDescription};
use App\Traits\ResponseJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MatarialDescriptionController extends Controller
{
    use  ResponseJson;

    public function __construct(private readonly MatarialDescription $MatarialDescriptionModel)
    {
    }

    public function show($id = null, Request $request)
    {
        // Get the week number from the request
        $weekNumber = $request->input('week_number');

        // Fetch the main material based on the ID
        $matarial = Matarial::where('id', $id)->first();

        // Fetch material details with descriptions and filtered education outputs
        $matrial_details = Matarial::with(['descriptions', 'education_output' => function ($query) use ($weekNumber) {
            if ($weekNumber) {
                $query->where('week_number', $weekNumber);
            }
        }])->where('id', $id)->get();

        // Return the view with the material details and the main material
        return view('admins.matrial_details.index', compact('matrial_details', 'matarial'));
    }

    public function create_matarial_description($matarial_id): \Illuminate\View\View
    {
        $matarial =Matarial::find($matarial_id) ;
        return view('admins.matrial_details.create' , compact('matarial_id' ,'matarial'));
    }

    public function create(): \Illuminate\View\View
    {

        return view('admins.matrial_details.create');
    }

    public function store(StoreMatarialDescriptionRequest $request)
    {
        $data = $request->all();
        $new_description = $this->MatarialDescriptionModel->create($request->except('outer-group', '_token'));
        return redirect()->route('dashboard.matarials_description.show' , $request->matarial_id )->with('success', 'تم أضافه التوصيف بنجاح');
    }

    private function insertTeachingOutputs(array $outputs, StoreMatarialDescriptionRequest $request , $new_description)
    {
        foreach ($outputs as $output) {
            foreach ($output as $item) {
                DB::table('teaching_outputs')->insert([
                    'week_number' => $request->week_number,
                    'matarial_id' => $request->matarial_id,
                    'name' => $item,
                    'added_by' => auth()->id(),
                ]);
            }
        }
    }



    public function destroy($matarial_id = null ): \Illuminate\Http\RedirectResponse
    {
        $matarial_description  = MatarialDescription::find($matarial_id);
        $matarial_description->delete() ;
        return redirect()->route('dashboard.matarials_description.show', $matarial_description->matarial_id )->with('success', ' تم  حذف الهدف  بنجاح');
    }

    public function edit($matarial_id)
    {
        $matarial_description  = MatarialDescription::find($matarial_id) ;
        return view('admins.matrial_details.edit' , compact('matarial_description')) ;
    }

    public function update(UpdateMatarialDescriptionRequest $updateMatarialDescriptionRequest, $id): \Illuminate\Http\RedirectResponse
    {
        $MatarialDescription = MatarialDescription::find($id);
        $MatarialDescription->update($updateMatarialDescriptionRequest->validated());
        return redirect()->route('dashboard.matarials_description.show', $MatarialDescription->matarial_id)->with('success', ' تم  تعديل  الهدف بنجاح');
    }
}
