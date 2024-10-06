<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Output\StoreMokrrerContentRequest;
use App\Http\Requests\Web\Admin\Output\UpdateMokrrerContentRequest;
use App\Models\Matarial;
use App\Models\MokrrerContent;
use App\Models\Program;
use App\Models\Student;
use App\Models\TeachingOutput;
use App\Traits\ResponseJson;
use Symfony\Component\HttpFoundation\Response;
use App\Services\PDFService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB ;
class MokrrerContentController extends Controller
{
    use  ResponseJson ;
    public function __construct(private readonly MokrrerContent $MokrrerContentModel)
    {}
    public function store(StoreMokrrerContentRequest $StoreMokrrerContentRequest): \Illuminate\Http\JsonResponse
    {
        $this->MokrrerContentModel->create($StoreMokrrerContentRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => ' تم أضافه الناتج  بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy($id = null): \Illuminate\Http\RedirectResponse
    {

        $output = MokrrerContent::where('id' ,$id)->first() ;
        $output->delete();
        return  redirect()->back()->with('success' , 'تم  حذف طريقه التعليم  والتعلم بنجاح') ;
    }

    public function edit(MokrrerContent $MokrrerContent): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson(['data' => $MokrrerContent], Response::HTTP_OK);
    }
    public function update(UpdateMokrrerContentRequest $updateMokrrerContentRequest, MokrrerContent $MokrrerContent): \Illuminate\Http\RedirectResponse
    {
        $MokrrerContent->update($updateMokrrerContentRequest->validated());
        return redirect()->route('dashboard.MokrrerContent.show' ,$MokrrerContent->program_id )->with('success', ' تم  تعديل  الهدف بنجاح');
    }

    public function saveChartImage(Request $request)
    {
        // Define the folder path
        $chartFolderPath = public_path('charts');

        // Check if the folder exists
        if (\File::exists($chartFolderPath)) {
            // Get all files in the folder
            $files = \File::files($chartFolderPath);

            // Loop through and delete each file
            foreach ($files as $file) {
                \File::delete($file);
            }
        }

        // Get the base64-encoded image data
        $imageData = $request->input('image');

        // Decode the image
        $image = str_replace('data:image/png;base64,', '', $imageData);
        $image = str_replace(' ', '+', $image);
        $imageName = 'chart_image.png';

        // Save the new image to the charts folder
        \File::put($chartFolderPath . '/' . $imageName, base64_decode($image));

        // Respond with a success message
        return response()->json(['success' => true, 'image' => $imageName]);
    }
    public function print_details($matarial_id)
    {
        // Fetching the Matarial with its relationships
        $matarial = Matarial::with(['descriptions', 'education_output', 'teaching_output'])->find($matarial_id);

        if (!$matarial) {
            // Handle the case where matarial is not found
            return redirect()->back()->with('error', 'Material not found.');
        }

        // Group the teaching outputs by 'type'
        $teachingOutputs = $matarial->teaching_output->groupBy('type');

        // Fetch the teaching outputs with the student grades for related questions
        $teaching_outputs = TeachingOutput::with('questions.student_grades')
            ->where('matarial_id', $matarial_id)
            ->get();

        $teachingOutputPercentages = [];

        // Calculating the percentage of students who scored between 50% and 100%
        foreach ($teaching_outputs as $output) {
            $totalStudents = Student::where('matarial_id', $matarial_id)->count();
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

            // Calculate average percentage for this teaching output
            $averagePercentage = $questionCount > 0 ? ($totalPercentage / $questionCount) : 0;
            $teachingOutputPercentages[$output->id] = $averagePercentage;
        }

        // Prepare data for the view
        $data = [
            'matarial' => $matarial,
            'output_1' => $teachingOutputs->get(1, collect()),
            'output_2' => $teachingOutputs->get(2, collect()),
            'output_3' => $teachingOutputs->get(3, collect()),
            'output_4' => $teachingOutputs->get(4, collect()),
            'report_name' => 'تقرير محتوى المقرر',
        ];

        // Return view with compact and array data
        return view('admins.reports.matrial_image', array_merge(compact('teaching_outputs', 'teachingOutputPercentages'), $data));
    }



    public function generate_matrial_pdf($id)
    {
        $chartImagePath = public_path('charts/chart_image.png');
        if (!file_exists($chartImagePath)) {
            // Handle case where image is not yet generated
            sleep(2); // Simple delay, or use other logic to ensure image is ready
        }
        $matarial = Matarial::with(['descriptions', 'education_output', 'teaching_output'])->find($id);

        if (!$matarial) {
            return abort(404, 'Material not found');
        }

        $teachingOutputs = $matarial->teaching_output->groupBy('type');
        $data = [
            'matarial' => $matarial,
            'output_1' => $teachingOutputs->get(1, collect()),
            'output_2' => $teachingOutputs->get(2, collect()),
            'output_3' => $teachingOutputs->get(3, collect()),
            'output_4' => $teachingOutputs->get(4, collect()),
            'chart_image' => $chartImagePath,
            'report_name' => 'تقرير محتوى المقرر',
        ];

        // Generate PDF and include the chart image
        $pdfService = new PDFService();
        $pdfService->generate_mokrrPDF($data, 'matarial.pdf');
    }





}
