<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Question ,Matarial};
use App\Models\Student;
use App\Models\StudentResult;
use Illuminate\Http\Request;
use App\Models\TeachingOutput ;

class StudentResultsController extends Controller
{
    public function student_results($teaching_output_id)
    {
        $teaching_output = TeachingOutput::find($teaching_output_id);
        $matarial = Matarial::where('id' , $teaching_output->matarial_id )->first() ;
        $questions = Question::where('teaching_outputs_id', $teaching_output->id)->get();
        $students = Student::where('matarial_id' , $matarial->id )->get();
        $students_results = StudentResult::get();
        return view('admins.results.index', compact('teaching_output', 'questions', 'students', 'students_results'));
    }
    public function saveStudentResults(Request $request)
    {

        $teaching_output_id = $request->input('teaching_output_id');
        $studentId = $request->input('student_id');
        $questionId = $request->input('question_id');
        $degree = $request->input('degree');


        // Update or create the student result
        StudentResult::updateOrCreate(
            [
                'teaching_output_id' => $teaching_output_id,
                'student_id' => $studentId,
                'question_id' => $questionId
            ],
            [
                'grade' => $degree
            ]
        );

        return response()->json(['message' => 'Result saved successfully!']);
    }

}
