<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\MomarsatFiles\StoreMomarsatFileRequest;
use App\Http\Requests\Web\Admin\MomarsatFiles\UpdateMomarsatFileRequest;
use App\Models\Mokasher;
use App\Models\Momarsa;
use App\Models\MomarsatFile;
use App\Traits\ResponseJson;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MomarsatFilesController extends Controller
{
    use ResponseJson;

    public function __construct(private readonly MomarsatFile $MomarsatFileModel){}

    public function show($momarsa_id): \Illuminate\View\View
    {
        $momarsa = Momarsa::with( 'mokasher.mayer.program')->find($momarsa_id);
        $program = $momarsa->mokasher->mayer->program ;
        $MomarsatFiles = $this->MomarsatFileModel->where('momarsa_id' ,$momarsa_id )->get();
        return view('admins.momarsat_files.index', compact('MomarsatFiles' , 'momarsa' ,'program'));
    }

    public function create(): \Illuminate\View\View
    {
        return view('admins.MomarsatFilet.create');
    }

    public function store(StoreMomarsatFileRequest $storeMomarsatFileRequest): \Illuminate\Http\JsonResponse
    {



        // Initialize the data to be saved
        $data = $storeMomarsatFileRequest->except('_token');

        // Check if a file is uploaded
        if ($storeMomarsatFileRequest->hasFile('file')) {
            // Get the uploaded file
            $file = $storeMomarsatFileRequest->file('file');

            // Generate a unique name for the file before saving it
            $filename = time() . '_' . $file->getClientOriginalName();

            // Move the file to the 'public/uploads/levels' directory
            $filePath = $file->move(public_path('uploads/momarse_files'), $filename);

            // Save the file path to the data array
            $data['file'] = 'uploads/momarse_files/' . $filename;
        }

        // Save the invoice data to the database
        $this->MomarsatFileModel->create($data);

        return $this->responseJson(['type' => 'success', 'message' => 'تم أضافة الملف  بنجاح  بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy($Id): \Illuminate\Http\RedirectResponse
    {
        $MomarsatFile  = MomarsatFile::find($Id) ;
        $MomarsatFile->delete();
        return redirect()->back()->with('success', 'تم حذف الممارسة بنجاح ');
    }

    public function edit($id): \Illuminate\Http\JsonResponse
    {
        $MomarsatFile  = MomarsatFile::find($id) ;
        return $this->responseJson(['data' => $MomarsatFile], Response::HTTP_OK);
    }

    public function update(UpdateMomarsatFileRequest $updateMomarsatFileRequest, $id): \Illuminate\Http\RedirectResponse
    {
        $MomarsatFile  = MomarsatFile::find($id) ;
        $MomarsatFile->update($updateMomarsatFileRequest->validated());
        return redirect()->back()->with('success', 'تم تعديل الممارسة بنجاح');
    }
}
