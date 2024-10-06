<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\programs\storeProgrameDescriptionReqest;
use App\Http\Requests\Web\Admin\programs\StoreProgramRequest;
use App\Http\Requests\Web\Admin\programs\UpdateProgramRequest;
use App\Models\College;
use App\Models\Matarial;
use App\Models\Program;
use App\Models\ProgramLevel;
use App\Models\Student;
use App\Models\TeachingOutput;
use App\Traits\ResponseJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;
use App\Services\PDFService;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ProgramController extends Controller
{
    use ResponseJson ;

    public function __construct(private readonly Program $programModel)
    {}

    public function show($college_id =null ): \Illuminate\View\View
    {
        $College  = College::find($college_id) ;
        $programs = $this->programModel->where('college_id' , $college_id)->get() ;

        $admin = Auth::guard('admin')->user() ;

        if($admin->suber_admin == 0 && empty($admin->program_id))
        {
            $programs = $this->programModel->where('college_id' , $college_id)->get();
        }
        else if($admin->suber_admin == 0 && !empty($admin->program_id))
        {
            $programs = $this->programModel->where('college_id' , $college_id)->where(['id' => $admin->program_id])->get();
        }else
        {
            $programs = $this->programModel->where('college_id' , $college_id)->get();
        }
        return view('admins.programs.index', compact('programs' ,  'college_id' ,'College' ));
    }
    public function create(): \Illuminate\View\View
    {
        return view('admins.programs.create');
    }

    public function store(StoreProgramRequest $storeProgramRequest): \Illuminate\Http\JsonResponse
    {
        $this->programModel->create($storeProgramRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => 'لقد تم أضافه البرنامج بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy(Program $program): \Illuminate\Http\RedirectResponse
    {
        $program->delete();
        return redirect()->route('dashboard.programs.show' ,$program->college_id )->with('success', 'لقد تم  حذف البرنامج  بنجاح');
    }

    public function edit(Program $program): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson(['data' => $program], Response::HTTP_OK);
    }

    public function update(UpdateProgramRequest $updateProgramRequest, Program $program): \Illuminate\Http\RedirectResponse
    {
        $program->update($updateProgramRequest->validated());
        return redirect()->route('dashboard.programs.show' , $program->college_id )->with('success', 'لقد تم  تعديل  البرنامج بنجاح');
    }
    public function details($id)
    {
        $program = Program::find($id) ;
        return view('admins.programs.show' , compact('program')) ;
    }
    public function store_details(storeProgrameDescriptionReqest $programeRequest)
    {
        Program::updateOrCreate(
            ['id' => $programeRequest->program_id],
            [
                'program' => $programeRequest->program,
                'type' => $programeRequest->type,
                'section' => $programeRequest->section,
                'added_date' => $programeRequest->added_date
            ]
        );

        return redirect()->back()->with('success', 'تم تحديث بيانات البرنامج بنجاح');
    }



    //program Details

    public function outputs($program_id)
    {
        $program = Program::find($program_id) ;
        return  view('admins.programs.details.outputs' , compact('program')) ;
    }

    public function matarilas($program_id)
    {
        $program = Program::find($program_id) ;
        $matarilas = [] ;
        return  view('admins.programs.details.matarilas.matails_1' , compact('program' , 'matarilas')) ;
    }
    //Output part functions

   public  function mind($program_id)
   {
       $program = Program::find($program_id) ;
       $matarilas = [] ;
       return  view('admins.programs.details.outputs.mind' , compact('program' , 'matarilas')) ;
   }
   public  function knows($program_id)
   {
       $program = Program::find($program_id) ;
       $matarilas = [] ;
       return  view('admins.programs.details.outputs.knows' , compact('program' , 'matarilas')) ;
   }
   // المعارات العلميه والعمليه
   public function e_skills($program_id)
   {
       $program = Program::find($program_id) ;
       $matarilas = [] ;
       return  view('admins.programs.details.outputs.e_skills' , compact('program' , 'matarilas')) ;
   }
   // المهارات العامه
    public function p_skills($program_id)
    {
        $program = Program::find($program_id) ;
        $matarilas = [] ;
        return  view('admins.programs.details.outputs.p_skills' , compact('program' , 'matarilas')) ;
    }
    public function a_skills($program_id)
    {
        $program = Program::find($program_id) ;
        $matarilas = [] ;
        return  view('admins.programs.details.outputs.a_skills' , compact('program' , 'matarilas')) ;
    }
    public function r_skills($program_id)
    {
        $program = Program::find($program_id) ;
        $matarilas = [] ;
        return  view('admins.programs.details.outputs.r_skills' , compact('program' , 'matarilas')) ;
    }
    public  function structure($program_id)
    {
        $program = Program::find($program_id) ;
        $matarilas = [] ;
        return  view('admins.programs.details.outputs.structure' , compact('program' , 'matarilas')) ;
    }
    public  function levels($program_id)
    {
        $program = Program::find($program_id);
        $files = ProgramLevel::where('program_id' , $program_id )->get() ;
        return view('admins.programs.details.levels.index', compact('program' ,'files'));
    }
    //المقررات
    //المقرر الألزامى
   public  function matails_1($program_id)
   {
       $program = Program::find($program_id);
       $matarilas = [];
       return view('admins.programs.details.matarilas.matails_1', compact('program', 'matarilas'));
   }
   //المقرر الانتقائي
    public  function matails_2($program_id)
    {
        $program = Program::find($program_id);
        $matarilas = [];
        return view('admins.programs.details.matarilas.matails_2', compact('program', 'matarilas'));
    }
    //المقرر الأختياري
    public  function matails_3($program_id)
    {
        $program = Program::find($program_id);
        $matarilas = [];
        return view('admins.programs.details.matarilas.matails_3', compact('program', 'matarilas'));
    }
    //حفظ  مستويات البرنامج
    public function store_levels(Request $request)
    {
        // Validate the request to ensure files are provided
        $request->validate([
            'levels.*' => 'required|mimes:pdf,doc,docx|max:2048'
        ]);

        $uploadedFiles = [];

        if ($request->hasFile('levels')) {
            foreach ($request->file('levels') as $file) {
                // Generate a unique name for the file before saving it
                $filename = time() . '_' . $file->getClientOriginalName();

                // Move the file to the 'public/uploads/levels' directory
                $file->move(public_path('uploads/levels'), $filename);

                // Save the file information to the database
                $programLevel = new ProgramLevel();
                $programLevel->program_id = $request->program_id;
                $programLevel->file_path = 'uploads/levels/' . $filename;
                $programLevel->save();

                // Collect the uploaded file paths for preview
                $uploadedFiles[] = 'uploads/levels/' . $filename;
            }
        }

        return redirect()->back()->with('success', 'تم أضافة ملفات مستويات بنجاح');
    }
    public  function  destory_level($id)
    {
       $level =  ProgramLevel::find($id) ;
        $level->delete() ;
        return redirect()->back()->with('success' ,  'تم حذف  ملفات المستوى  بنجاح') ;
    }


    //قياس نواتج التعلم لكل البرامج
    public function output_education_program_report()
    {
        // Eager load relationships to avoid lazy loading issues
        $programs = Program::with([
            'matarials.education_output.questions.student_grades',
            'matarials.education_output.questions'  // Ensure questions are loaded
        ])->get();

        $programPercentages = [];

        foreach ($programs as $program) {
            // Get total number of students across all materials in the program
            $totalStudents = Student::whereIn('matarial_id', $program->matarials->pluck('id'))->count();

            $totalMaterialPercentage = 0;
            $materialCount = 0;

            foreach ($program->matarials as $matrial) {
                $teaching_outputs = TeachingOutput::where('matarial_id', $matrial->id)->with('questions.student_grades')->get();

                $totalMaterialPercentageForMatrial = 0;
                $teachingOutputCount = 0;

                foreach ($teaching_outputs as $output) {
                    if ($output->questions->isNotEmpty()) {
                        $questions = $output->questions;

                        $totalOutputPercentage = 0;
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
                            $totalOutputPercentage += $percentageInRange;
                        }

                        $averagePercentageForOutput = $questionCount > 0 ? ($totalOutputPercentage / $questionCount) : 0;
                        $totalMaterialPercentageForMatrial += $averagePercentageForOutput;
                        $teachingOutputCount++;
                    }

                    // Calculate the average percentage for the material
                    $averageMaterialPercentage = $teachingOutputCount > 0 ? ($totalMaterialPercentageForMatrial / $teachingOutputCount) : 0;
                    $totalMaterialPercentage += $averageMaterialPercentage;
                    $materialCount++;
                }
            }

            // Calculate the overall average percentage for the program
            $programAveragePercentage = $materialCount > 0 ? ($totalMaterialPercentage / $materialCount) : 0;
            $programPercentages[$program->id] = $programAveragePercentage;
        }

        return view('admins.reports.education_output_report_programs', compact('programs', 'programPercentages'));
    }

    // print program Details


    public function saveprogramChartImage(Request $request)
    {
        // Define the folder path
        $chartFolderPath = public_path('charts/program');

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
    public function print_details($program_id)
    {
        $program = Program::find($program_id);
        $matarials = Matarial::with(['descriptions', 'education_output', 'teaching_output'])
            ->where('program_id', $program_id)
            ->get();
        $matriles_1 = Matarial::where('type', 1)->get();
        $matriles_2 = Matarial::where('type', 2)->get();
        $matriles_3 = Matarial::where('type', 3)->get();
        $matriles_4 = Matarial::where('type', 4)->get();

        if ($matarials->isEmpty()) {
            return redirect()->back()->with('error', 'No materials found for this program.');
        }

        $teachingOutputPercentages = [];

        foreach ($matarials as $matarial) {
            $teaching_outputs = TeachingOutput::with('questions.student_grades')
                ->where('matarial_id', $matarial->id)
                ->get();

            $totalPercentage = 0;
            $questionCount = 0;

            foreach ($teaching_outputs as $output) {
                $totalStudents = Student::where('matarial_id', $matarial->id)->count();
                $questions = $output->questions;

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
                    $questionCount++;
                }
            }

            $averagePercentage = $questionCount > 0 ? ($totalPercentage / $questionCount) : 0;
            $teachingOutputPercentages[$matarial->name] = $averagePercentage;  // Using material name as the key
        }

        $data = [
            'program' => $program,
            'matarials' => $matarials,
            'matriles_1' => $matriles_1,
            'matriles_2' => $matriles_2,
            'matriles_3' => $matriles_3,
            'matriles_4' => $matriles_4,
            'teachingOutputPercentages' => $teachingOutputPercentages,
            'report_name' => 'تقرير محتوى المقرر',
        ];

        return view('admins.reports.program_image', $data);
    }



    public function generate_program_pdf($program_id)
    {

        $chartImagePath = public_path('charts/program/chart_image.png');
        if (!file_exists($chartImagePath)) {
            // Handle case where image is not yet generated
            sleep(2); // Simple delay, or use other logic to ensure image is ready
        }
        $program = Program::with('goals', 'matarials')->find($program_id);
        // Separate the materials by type
        $matriles_1 = $program->matarials->where('type', 0); // No need for get() when using collection filters
        $matriles_2 = $program->matarials->where('type', 1);
        $matriles_3 = $program->matarials->where('type', 2);

        if (!$program) {
            return abort(404, 'Material not found');
        }

        $data = [
            'program' => $program,
            'report_name' => ' تقرير البرنامج 2024 ',
            'matriles_1' => $matriles_1,
            'matriles_2' => $matriles_2,
            'matriles_3' => $matriles_3 ,
            'programImage' => $chartImagePath
        ];

        // Generate PDF and include the chart image
        $pdfService = new PDFService();
        $pdfService->generate_programPDF($data, 'program.pdf');
    }
    public function connect_output($matrial_id)
    {
        $matrial  = Matarial::find($matrial_id);
        // Retrieve all materials associated with the given program, including their related education outputs and other necessary relationships
        $matrila_output_educations = Matarial::with(
            'education_output',
            'program',
            'program.mind',
            'program.knowledge',
            'program.workskills',
            'program.public_skills'
        )->where('id', $matrial_id)->get();

        // Fetch existing matches for all materials related to this program
        $existingMatches = DB::table('material_program_matches')
            ->whereIn('material_id', $matrila_output_educations->pluck('id'))
            ->get()
            ->groupBy('material_id');

        return view('admins.programs.details.arrays_eduction_results.index', compact('matrila_output_educations', 'existingMatches', 'matrial'));
    }

    public function store_matches(Request $request, $matrial_id)
    {
        $matches = $request->input('match', []);

        // Prepare data to be upserted for all materials
        $upsertData = [];
        foreach ($matches as $materialId => $outputs) {
            foreach ($outputs as $educationOutputId => $categories) {
                foreach ($categories as $category => $programOutputIds) {
                    foreach ($programOutputIds as $programOutputId) {
                        $upsertData[] = [
                            'material_id' => $materialId,
                            'education_output_id' => $educationOutputId,
                            'program_output_id' => $programOutputId,
                            'category' => $category,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }
            }
        }

        // Fetch existing matches for all materials related to this program
        $materials = Matarial::where('id', $matrial_id)->pluck('id');
        $existingMatches = DB::table('material_program_matches')
            ->whereIn('material_id', $materials)
            ->get();

        // Extract existing keys for comparison
        $existingMatchKeys = $existingMatches->map(function ($match) {
            return $match->material_id . '-' . $match->education_output_id . '-' . $match->program_output_id . '-' . $match->category;
        })->toArray();

        // Extract the keys from the new upsert data
        $upsertMatchKeys = collect($upsertData)->map(function ($match) {
            return $match['material_id'] . '-' . $match['education_output_id'] . '-' . $match['program_output_id'] . '-' . $match['category'];
        })->toArray();

        // Find out the new records to be inserted (those not existing in the database already)
        $filteredUpsertData = array_filter($upsertData, function ($match) use ($existingMatchKeys) {
            $key = $match['material_id'] . '-' . $match['education_output_id'] . '-' . $match['program_output_id'] . '-' . $match['category'];
            return !in_array($key, $existingMatchKeys);
        });

        // Find out which existing records need to be deleted (unchecked ones)
        $matchesToDelete = array_filter($existingMatches->toArray(), function ($match) use ($upsertMatchKeys) {
            $key = $match->material_id . '-' . $match->education_output_id . '-' . $match->program_output_id . '-' . $match->category;
            return !in_array($key, $upsertMatchKeys);
        });

        // Delete the unchecked matches
        if (!empty($matchesToDelete)) {
            foreach ($matchesToDelete as $matchToDelete) {
                DB::table('material_program_matches')
                    ->where('material_id', $matchToDelete->material_id)
                    ->where('education_output_id', $matchToDelete->education_output_id)
                    ->where('program_output_id', $matchToDelete->program_output_id)
                    ->where('category', $matchToDelete->category)
                    ->delete();
            }
        }

        // Insert new records (filtered ones)
        if (!empty($filteredUpsertData)) {
            DB::table('material_program_matches')->insert($filteredUpsertData);
        }

        return redirect()->back()->with('success', 'تم حفظ الربط بنجاح');
    }
    // تقرير قياس  نواتج التعلم للبرنامج
    public function program_outputs_education_report($program_id = null)
    {
        $program = Program::find($program_id);
        // Get all materials related to the program
        $materials = Matarial::where('program_id', $program_id)->get(); // Assuming there's a program_id in the materials table

        $materialPercentages = [];

        foreach ($materials as $material) {
            $teaching_outputs = TeachingOutput::with('questions.student_grades')
                ->where('matarial_id', $material->id)
                ->get();

            $teachingOutputPercentages = [];

            foreach ($teaching_outputs as $output) {
                $totalStudents = Student::where('matarial_id', $material->id)->count();
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

            // Calculate average percentage for this material
            $materialAveragePercentage = count($teachingOutputPercentages) > 0 ? array_sum($teachingOutputPercentages) / count($teachingOutputPercentages) : 0;
            $materialPercentages[$material->id] = $materialAveragePercentage;
        }

        return view('admins.reports.education_program_report', compact('program', 'materials', 'materialPercentages'));

    }

    //تقرير ربط مواتج التعلم بالبرنامج
    public function showReport($program_id)
    {
        // Fetch the data for the specific program
        $programOutputs = DB::table('material_program_matches')
            ->join('program_outputs', 'material_program_matches.program_output_id', '=', 'program_outputs.id')
            ->select(
                'program_outputs.name as program_output_name',
                'program_outputs.category', // Assuming you have a 'category' column that indicates 'mind', 'knowledge', etc.
                DB::raw('COUNT(material_program_matches.material_id) as material_count')
            )
            ->where('program_outputs.program_id', $program_id)
            ->groupBy('material_program_matches.program_output_id', 'program_outputs.name', 'program_outputs.category')
            ->get();

        // Calculate the total count to derive percentages for each category
        $totalOutputsByCategory = $programOutputs->groupBy('category')->map(function ($group) {
            return $group->sum('material_count');
        });

        // Calculate percentage for each program output within its category
        $programOutputData = $programOutputs->map(function ($output) use ($totalOutputsByCategory) {
            return [
                'name' => $output->program_output_name,
                'category' => $output->category,
                'count' => $output->material_count,
                'percentage' => round(($output->material_count / $totalOutputsByCategory[$output->category]) * 100, 2),
            ];
        });

        return view('dashboard.admins.reports.connect_report_program', compact('programOutputData'));
    }


}
