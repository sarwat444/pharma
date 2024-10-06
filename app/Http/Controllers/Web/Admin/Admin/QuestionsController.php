<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Questions\StoreQuestionRequest;
use App\Http\Requests\Web\Admin\Questions\UpdateQuestionRequest;
use App\Models\Matarial;
use App\Models\{Program, Question, TeachingOutput, StudentResult, Student};
use \App\Http\Controllers\Web\Admin\Admin\OutputEduction;
use App\Traits\ResponseJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Services\PDFService;

class QuestionsController extends Controller
{
    use ResponseJson;

    public function __construct(private readonly Question $QuestionModel){}


    public function output_education_questions($material_id)
    {
        $matarial = Matarial::find($material_id) ;
        $teaching_outputs  = TeachingOutput::where('matarial_id', $material_id)->get();
        return  view('admins.output_education_questions.index' , compact('teaching_outputs' ,'matarial')) ;
    }

    public function show($teaching_output_id): \Illuminate\View\View
    {
        $teaching_output = TeachingOutput::find($teaching_output_id);
        $matarial = Matarial::where('id' , $teaching_output->matarial_id )->first() ;
        $totalStudents = Student::where('matarial_id' , $matarial->id )->count();  // Total number of students
        $teaching_outputs = TeachingOutput::where('matarial_id', $teaching_output->matarial_id)->get();

        // Fetch all questions with their student grades
        $questions = $this->QuestionModel->with('student_grades')->where('teaching_outputs_id', $teaching_output_id)->get();

        // Initialize arrays to hold percentage data
        $questionPercentages = [];

        foreach ($questions as $question) {
            // Get all grades for the current question
            $grades = $question->student_grades;

            // Initialize a set to keep track of students who scored between 50% and 100% for this question
            $studentsInRange = [];

            foreach ($grades as $grade) {
                $percentage = ($grade->grade / $question->h_degree) * 100;

                // Check if the percentage is within the desired range
                if ($percentage >= 50 && $percentage <= 100) {
                    $studentsInRange[$grade->student_id] = true;  // Mark student as in range
                }
            }

            // Calculate the percentage of students in the range for the current question
            $studentsInRangeCount = count($studentsInRange);
            $percentageInRange = $totalStudents > 0 ? ($studentsInRangeCount / $totalStudents) * 100 : 0;
            $questionPercentages[$question->id] = $percentageInRange;
        }

        // Calculate the overall percentage of students in the 50%-100% range relative to all students
        return view('admins.questions.index', compact('questions', 'teaching_outputs', 'teaching_output', 'questionPercentages' , 'matarial'));
    }
    public function create(): \Illuminate\View\View
    {
        return view('admins.questions.create');
    }

    public function   store(StoreQuestionRequest $storeQuestionRequest): \Illuminate\Http\JsonResponse
    {
        $this->QuestionModel->create($storeQuestionRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => 'Question created successfully.'], Response::HTTP_CREATED);
    }

    public function destroy($id = null ): \Illuminate\Http\RedirectResponse
    {
        $Question = Question::find($id) ;
        $Question->delete();
        return redirect()->back()->with('success' , 'تم حذف  السؤال بنجاح ') ;
    }

    public function edit($id): \Illuminate\Http\JsonResponse
    {
        $Question  = Question::find($id) ;
        return $this->responseJson(['data' => $Question], Response::HTTP_OK);
    }

    public function update(UpdateQuestionRequest $updateQuestionRequest, $id): \Illuminate\Http\RedirectResponse
    {
        $Question  = Question::find($id) ;
        $Question->update($updateQuestionRequest->validated());
        return redirect()->back()->with('success', 'Question updated');
    }
    public function generate_questions_pdf($teaching_output_id)
    {
        $teaching_output = TeachingOutput::with('questions')->where('id' , $teaching_output_id)->first() ;
        $data = [
            'report_name' => 'تقرير أسئلة ناتج التعلم' ,
            'teaching_output' => $teaching_output ,
        ];

        // Generate PDF using TCPDF
        $pdfService = new PDFService();
        $pdfService->generaTeachingOutPDF($data, 'output.pdf');
    }

    public function generate_all_questions_pdf($matrial_id)
    {
        $teaching_outputs = TeachingOutput::with('questions')->where(['matarial_id' => $matrial_id ])->get() ;
        $data = [
            'report_name' => 'تقرير أسئلة ناتج التعلم' ,
            'teaching_outputs' => $teaching_outputs ,
        ];

        // Generate PDF using TCPDF
        $pdfService = new PDFService();
        $pdfService->generaallTeachingOutPDF($data, 'output.pdf');
    }

    public function outputs_education_report($matarial_id = null)
    {
       $mokrrer =  Matarial::find($matarial_id)->first() ;
        $teaching_outputs = TeachingOutput::with('questions.student_grades')
            ->where('matarial_id', $matarial_id)
            ->get();

        $teachingOutputPercentages = [];

        foreach ($teaching_outputs as $output) {
            $totalStudents = Student::where('matarial_id' , $matarial_id)->count();
            $questions = $output->questions;

            $totalPercentage = 0;
            $questionCount = $questions->count();

            foreach ($questions as $question) {
                $grades = $question->student_grades;

                $studentsInRange = [];

                foreach ($grades as $grade) {
                    $percentage = ($grade->grade / $question->h_degree) * 100;

                    if ($percentage >= 50 && $percentage <= 100) {
                        $studentsInRange[$grade->student_id] = true;
                    }
                }

                $studentsInRangeCount = count($studentsInRange);
                $percentageInRange = $totalStudents > 0 ? ($studentsInRangeCount / $totalStudents) * 100 : 0;
                $totalPercentage += $percentageInRange;
            }

            $averagePercentage = $questionCount > 0 ? ($totalPercentage / $questionCount) : 0;
            $teachingOutputPercentages[$output->id] = $averagePercentage;
        }
        return view('admins.reports.education_output_report', compact('teaching_outputs', 'teachingOutputPercentages' ,'mokrrer'));
    }

}
