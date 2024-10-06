<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Survey\StoreSurveyRequest;
use App\Http\Requests\Web\Admin\Survey\UpdateSurveyRequest;
use App\Models\Matarial;
use App\Traits\ResponseJson;
use Illuminate\Http\Request;
use App\Models\Survey ;
use App\Models\StudentSurveyAnswer;
use Illuminate\Support\Facades\DB ;
use Symfony\Component\HttpFoundation\Response;

class SurveyController extends Controller
{
    use ResponseJson;

    public function __construct(private readonly Survey $SurveyModel)
    {
    }

    public function show($matarial_id): \Illuminate\View\View
    {
        $matarial =  Matarial::find($matarial_id);
        $survies = $this->SurveyModel->where('matarial_id' ,$matarial_id )->withCount('categories')->get();
        return view('admins.survies.index', compact('survies'  , 'matarial_id' ,'matarial'));
    }

    public function create(): \Illuminate\View\View
    {
        return view('admins.survies.create');
    }

    public function   store(StoreSurveyRequest $storeSurveyRequest): \Illuminate\Http\JsonResponse
    {
       $this->SurveyModel->create($storeSurveyRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => 'Survey created successfully.'], Response::HTTP_CREATED);
    }

    public function destroy($id = null ): \Illuminate\Http\RedirectResponse
    {
        $Survey = Survey::find($id) ;
        $Survey->delete();
        return redirect()->back()->with('success', 'تم حذف  الأستبيان بنجاح');
    }

    public function edit(Survey $Survey): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson(['data' => $Survey], Response::HTTP_OK);
    }

    public function update(UpdateSurveyRequest $updateSurveyRequest, Survey $Survey): \Illuminate\Http\RedirectResponse
    {
        $Survey->update($updateSurveyRequest->validated());
        return redirect()->back()->with('success', 'تم تعديل الأستبيان بنجاح');
    }
    public function view_details($survey_id)
    {
        $survey = Survey::with('categories.questions')->find($survey_id) ;
        $matarial = Matarial::where('id' , $survey->matarial_id)->first() ;
        return view('admins.survies.details' ,compact('survey' , 'matarial') ) ;
    }
    public function view_statitastics($survey_id)
    {
        // إجمالي عدد الطلاب
        $totalStudents = StudentSurveyAnswer::distinct('student_id')->count('student_id');

        // عدد الإجابات
        $totalAnswers = StudentSurveyAnswer::whereHas('question.category', function ($query) use ($survey_id) {
            $query->where('survey_id', $survey_id);
        })->count();

        $statistics = [];
        $answerLabels = ["ضعيف جدا", "ضعيف", "مقبول", "جيد", "ممتاز"]; // الفئات باللغة العربية

        foreach ($answerLabels as $index => $label) {
            $count = StudentSurveyAnswer::where('answer', $index + 1)
                ->whereHas('question.category', function ($query) use ($survey_id) {
                    $query->where('survey_id', $survey_id);
                })->count();

            $percentage = $totalAnswers > 0 ? round(($count / $totalAnswers) * 100) : 0; // تقريب الأعداد
            $statistics[$label] = [
                'count' => $count,
                'percentage' => $percentage,
            ];
        }

        return view('admins.survies.statistics', compact('statistics', 'survey_id', 'totalStudents'));
    }




}
