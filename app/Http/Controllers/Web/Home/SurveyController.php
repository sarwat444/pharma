<?php

namespace App\Http\Controllers\Web\Home;

use App\Http\Controllers\Controller;
use App\Models\Matarial;
use App\Models\Survey;
use App\Models\SurveyQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;
use App\Models\StudentMatarial;
use App\Models\StudentSurveyAnswer ;

class SurveyController extends Controller
{
    public function show($survey_id)
    {
        $student_id = Auth::guard('student')->user()->id ;
        $survey = Survey::with('categories.questions')->find($survey_id) ;
        $matarial = Matarial::where('id' , $survey->matarial_id)->first() ;
        return view('home.students.survies.details' , compact('survey' ,'matarial')) ;
    }
    public function survies($matarial_id = null)
    {
        $student = Auth::guard('student')->user();

        // Get the IDs of questions that the student has answered
        $completedQuestionIds = StudentSurveyAnswer::where('student_id', $student->id)
            ->pluck('question_id')
            ->unique()
            ->toArray();

        // Fetch surveys along with the material and categories with their questions
        $survies = Survey::with(['matarial', 'categories.questions'])->where('matarial_id', $matarial_id)->get();

        // Attach a 'completed' property to each survey
        foreach ($survies as $survey) {
            // Check if any of the questions in the survey have been answered by the student
            $survey->completed = $survey->categories->flatMap(function ($category) {
                return $category->questions;
            })->pluck('id')->intersect($completedQuestionIds)->isNotEmpty();
        }

        $matarials = StudentMatarial::with('matarial', 'student')->where('student_id', $student->id)->get();
        return view('home.students.survies.index', compact('survies', 'matarials'));
    }

    public function store(Request $request)
    {
        $studentId = auth()->id();

        // Check if the student has already completed the survey
        $existingAnswers = StudentSurveyAnswer::where('student_id', $studentId)
            ->whereIn('question_id', array_keys($request->input('answers')))
            ->exists();

        if ($existingAnswers) {
            return redirect()->back()->with('error', 'لقد قمت بملئ الأستبيان من قبل .');
        }

        // Validate the input
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|in:1,2,3,4,5',
        ]);

        // Validate that all question_ids exist
        $questionIds = array_keys($request->input('answers'));
        $validQuestionIds = SurveyQuestion::whereIn('id', $questionIds)->pluck('id')->toArray();

        // Check if any question_id is invalid
        $invalidIds = array_diff($questionIds, $validQuestionIds);
        if (!empty($invalidIds)) {
            return redirect()->back()->with('error', 'بعض الأسئلة غير صحيحة.');
        }

        // Store the survey answers
        foreach ($request->input('answers') as $questionId => $answer) {
            StudentSurveyAnswer::create([
                'question_id' => $questionId,
                'student_id' => $studentId,
                'answer' => $answer,
            ]);
        }

        return redirect()->back()->with('success', 'Survey submitted successfully!');
    }




}
