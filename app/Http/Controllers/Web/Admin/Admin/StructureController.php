<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Output\StoreStructureRequest;
use App\Http\Requests\Web\Admin\Output\UpdateStructureRequest;
use App\Models\Program;
use App\Models\Structure;
use App\Traits\ResponseJson;
use Symfony\Component\HttpFoundation\Response;

class StructureController extends Controller
{
    use  ResponseJson ;
    public function __construct(private readonly Structure $StructureModel)
    {}
    public  function  show($program_id =null)
    {
        $program = Program::find($program_id) ;
        $structures = $this->StructureModel->where('program_id' , $program_id )->get();
        return view('admins.programs.details.structures.index', compact('structures' , 'program'));
    }
    public function create(): \Illuminate\View\View
    {
        return view('admins.Structure.create');
    }
    public function store(StoreStructureRequest $request): \Illuminate\Http\JsonResponse
    {
        // Initialize the data array with validated request data
        $data = $request->validated();

        if ($request->hasFile('file_path')) {
            // Get the uploaded file
            $file = $request->file('file_path');

            // Generate a unique name for the file before saving it
            $filename = time() . '_' . $file->getClientOriginalName();

            // Move the file to the 'public/uploads/structure' directory
            $file->move(public_path('uploads/structure'), $filename);

            // Save the file path to the data array
            $data['file_path'] =  $filename;
        }

        // Create the structure using the validated data
        $this->StructureModel->create($data);

        return $this->responseJson(['type' => 'success', 'message' => 'تم أضافه الهيكل بنجاح'], Response::HTTP_CREATED);
    }


    public function destroy($id ): \Illuminate\Http\RedirectResponse
    {
        $Structure = Structure::find($id) ;
        $Structure->delete();
        return redirect()->route('dashboard.structures.show' , $Structure['program_id'])->with('success', ' تم  حذف الهيكل   بنجاح');
    }

    public function edit($id): \Illuminate\Http\JsonResponse
    {
        $Structure = Structure::find($id) ;
        return $this->responseJson(['data' => $Structure], Response::HTTP_OK);
    }
    public function update(UpdateStructureRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        // Find the structure by its ID
        $structure = Structure::find($id);

        // Get the validated data from the request
        $data = $request->validated();

        if ($request->hasFile('file_path')) {




            // Get the uploaded file
            $file = $request->file('file_path');

            // Generate a unique name for the file before saving it
            $filename = time() . '_' . $file->getClientOriginalName();

            // Move the file to the 'public/uploads/structure' directory
            $file->move(public_path('uploads/structure'), $filename);

            // Save the file path to the data array
            $data['file_path'] =  $filename;
        }

        // Update the structure with the validated data
        $structure->update($data);

        // Redirect to the appropriate route with a success message
        return redirect()->route('dashboard.structures.show', $structure->program_id)
            ->with('success', 'تم تعديل الهيكل بنجاح');
    }


}
