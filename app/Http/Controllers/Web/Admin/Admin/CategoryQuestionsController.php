<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Traits\ResponseJson;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\CategoryQuestion ;
use App\Http\Requests\Web\Admin\Survey\StoreCategoryQuestionRequest;
use App\Http\Requests\Web\Admin\Survey\UpdateCategoryQuestionRequest;


class CategoryQuestionsController extends Controller
{
    use ResponseJson;

    public function __construct(private readonly CategoryQuestion $CategoryQuestionModel)
    {
    }

    public function show($survey_id): \Illuminate\View\View
    {
        $categories = $this->CategoryQuestionModel->where('survey_id' ,$survey_id )->get();
        return view('admins.category_questions.index', compact('categories'  , 'survey_id'));
    }

    public function create(): \Illuminate\View\View
    {
        return view('admins.category_questions.create');
    }

    public function   store(StoreCategoryQuestionRequest $storeCategoryQuestionRequest): \Illuminate\Http\JsonResponse
    {
        $this->CategoryQuestionModel->create($storeCategoryQuestionRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => 'تم أضافة محور الاسئلة بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy($id=null): \Illuminate\Http\RedirectResponse
    {
        $CategoryQuestion = $this->CategoryQuestionModel->find($id) ;
        $CategoryQuestion->delete();
        return redirect()->back()->with('success', 'تم حذف المحور بنجاح');
    }

    public function edit($id=null): \Illuminate\Http\JsonResponse
    {
        $CategoryQuestion = $this->CategoryQuestionModel->find($id) ;
        return $this->responseJson(['data' => $CategoryQuestion], Response::HTTP_OK);
    }

    public function update(UpdateCategoryQuestionRequest $updateCategoryQuestionRequest, $id): \Illuminate\Http\RedirectResponse
    {
        $CategoryQuestion = $this->CategoryQuestionModel->find($id) ;
        $CategoryQuestion->update($updateCategoryQuestionRequest->validated());
        return redirect()->back()->with('success', 'تم تعديل  المحور  بنجاح');
    }
}
