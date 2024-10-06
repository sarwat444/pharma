<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Output\StoreTaqweemRequest;
use App\Http\Requests\Web\Admin\Output\UpdateTaqweemRequest;
use App\Models\Taqweem;
use App\Traits\ResponseJson;
use  Illuminate\Support\Facades\Request ;
use Symfony\Component\HttpFoundation\Response;

class TaqweemController extends Controller
{
    use  ResponseJson ;
    public function __construct(private readonly Taqweem $TaqweemModel)
    {}
    public function store(StoreTaqweemRequest $StoreTaqweemRequest): \Illuminate\Http\JsonResponse
    {
        $this->TaqweemModel->create($StoreTaqweemRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => ' تم أضافه أسلوب  التقويم بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy($id = null): \Illuminate\Http\RedirectResponse
    {
        $output = Taqweem::where('id' ,$id)->first() ;
        $output->delete();
        return redirect()->back()->with('success' ,  'تمك حذف  أسلوب التقويم بنجاح');
    }

    public function edit(Taqweem $Taqweem): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson(['data' => $Taqweem], Response::HTTP_OK);
    }
    public function update(UpdateTaqweemRequest $updateTaqweemRequest, Taqweem $Taqweem): \Illuminate\Http\RedirectResponse
    {
        $Taqweem->update($updateTaqweemRequest->validated());
        return redirect()->route('dashboard.Taqweem.show' ,$Taqweem->program_id )->with('success', ' تم  تعديل  الهدف بنجاح');
    }
    public function change_taqweem_active(Request $request)
    {
        $id = Request::input('id');

        $method = Taqweem::find($id);

        if ($method) {
            $method->active = !$method->active;
            $method->save();

            return response()->json(['type' => 'success', 'message' => 'تم التعديل بنجاح'], \Illuminate\Http\Response::HTTP_OK);
        } else {
            return response()->json(['type' => 'error', 'message' => 'الطريقة غير موجودة'], \Illuminate\Http\Response::HTTP_NOT_FOUND);
        }
    }
}
