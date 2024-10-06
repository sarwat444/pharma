<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Survey\StoreSurveyQuestionRequest;
use App\Http\Requests\Web\Admin\Survey\UpdateSurveyQuestionRequest;
use App\Models\CategoryQuestion;
use App\Models\SurveyQuestion;
use App\Traits\ResponseJson;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveyQuestionsController extends Controller
{
    use ResponseJson;

    public function __construct(private readonly SurveyQuestion $SurveyQuestionModel)
    {
    }

    public function show($category_id): \Illuminate\View\View
    {
        $category = CategoryQuestion::find($category_id) ;
        $questions = $this->SurveyQuestionModel->where([ 'category_id' => $category_id ])->get();
        return view('admins.survey_questions.index', compact('questions'  , 'category_id'));
    }

    public function create(): \Illuminate\View\View
    {
        return view('admins.survey_questions.create');
    }

    public function store(StoreSurveyQuestionRequest $storeSurveyQuestionRequest): \Illuminate\Http\JsonResponse
    {
        $this->SurveyQuestionModel->create($storeSurveyQuestionRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => 'تم أضافة السؤال بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy($id=null): \Illuminate\Http\RedirectResponse
    {
        $SurveyQuestion = $this->SurveyQuestionModel->find($id) ;
        $SurveyQuestion->delete();
        return redirect()->back()->with('success', 'تم حذف السؤال بنجاح');
    }

    public function edit($id=null): \Illuminate\Http\JsonResponse
    {
        $SurveyQuestion = $this->SurveyQuestionModel->find($id) ;
        return $this->responseJson(['data' => $SurveyQuestion], Response::HTTP_OK);
    }

    public function update(UpdateSurveyQuestionRequest $updateSurveyQuestionRequest, $id): \Illuminate\Http\RedirectResponse
    {
        $SurveyQuestion = $this->SurveyQuestionModel->find($id) ;
        $SurveyQuestion->update($updateSurveyQuestionRequest->validated());
        return redirect()->back()->with('success', 'تم تعديل  السؤال بنجاح');
    }
}
