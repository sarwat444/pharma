<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\MomarsatMokassyFiles\StoreMomarsatMokassyFileRequest;
use App\Http\Requests\Web\Admin\MomarsatMokassyFiles\UpdateMomarsatMokassyFileRequest;
use App\Models\MomarsaMokassya;
use App\Models\MomarsatMokassyFile;
use App\Traits\ResponseJson;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MomarsatMokassyFilesController extends Controller
{
    use ResponseJson;

    public function __construct(private readonly MomarsatMokassyFile $MomarsatMokassyFileModel){}

    public function show($momarsa_id): \Illuminate\View\View
    {
        $momarsa = MomarsaMokassya::find($momarsa_id);
        $MomarsatFiles   = $this->MomarsatMokassyFileModel->where('momarsa_id' ,$momarsa_id )->get();
        return view('admins.momarsat_files_mokassya.index', compact('MomarsatFiles' , 'momarsa'));
    }

    public function create(): \Illuminate\View\View
    {
        return view('admins.momarsat_files_mokassya.create');
    }

    public function store(StoreMomarsatMokassyFileRequest $storeMomarsatMokassyFileRequest): \Illuminate\Http\JsonResponse
    {
        // Initialize the data to be saved
        $data = $storeMomarsatMokassyFileRequest->except('_token');

        // Check if a file is uploaded
        if ($storeMomarsatMokassyFileRequest->hasFile('file')) {
            // Get the uploaded file
            $file = $storeMomarsatMokassyFileRequest->file('file');

            // Generate a unique name for the file before saving it
            $filename = time() . '_' . $file->getClientOriginalName();

            // Move the file to the 'public/uploads/levels' directory
            $filePath = $file->move(public_path('uploads/momarse_mokassy_files'), $filename);

            // Save the file path to the data array
            $data['file'] = 'uploads/momarse_mokassy_files/' . $filename;
        }

        // Save the invoice data to the database
        $this->MomarsatMokassyFileModel->create($data);

        return $this->responseJson(['type' => 'success', 'message' => 'تم أضافة الملف  بنجاح  بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy($Id): \Illuminate\Http\RedirectResponse
    {
        $MomarsatMokassyFile  = MomarsatMokassyFile::find($Id) ;
        $MomarsatMokassyFile->delete();
        return redirect()->back()->with('success', 'تم حذف الممارسة بنجاح ');
    }

    public function edit($id): \Illuminate\Http\JsonResponse
    {
        $MomarsatMokassyFile  = MomarsatMokassyFile::find($id) ;
        return $this->responseJson(['data' => $MomarsatMokassyFile], Response::HTTP_OK);
    }

    public function update(UpdateMomarsatMokassyFileRequest $updateMomarsatMokassyFileRequest, $id): \Illuminate\Http\RedirectResponse
    {
        $MomarsatMokassyFile  = MomarsatMokassyFile::find($id) ;
        $MomarsatMokassyFile->update($updateMomarsatMokassyFileRequest->validated());
        return redirect()->back()->with('success', 'تم تعديل الممارسة بنجاح');
    }
}
