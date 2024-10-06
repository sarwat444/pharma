<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\Matarial;
use App\Models\Student;
use App\Exports\StudentsExport;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function __construct(private readonly Student $studentModel){}

    public  function show($matarial_id =null)
    {
        $matrial  = Matarial::where('id' , $matarial_id)->first() ;
        $students  =  $this->studentModel->where('matarial_id', $matarial_id)->get() ;
        return view('admins.students.index' , compact('students' , 'matrial')) ;
    }
    public  function edit($id)
    {
        $student = Student::find($id);
        $matarials  = Matarial::get() ;
        return view('admins.students.edit' , compact('student' ,'matarials')) ;
    }
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'sometimes|nullable|string|min:8',
        ]);

        // Find the student by id
        $student = Student::findOrFail($id);

        // Update the student with the validated data
        $student->name = $validatedData['name'];
        $student->email = $validatedData['email'];

        // If a password is provided, hash it and update
        if (!empty($validatedData['password'])) {
            $student->password = bcrypt($validatedData['password']);
        }

        // Save the updated student information
        $student->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'تم تعديل  بيانات الطالب  بنجاح');
    }
    public  function destroy ($id)
    {
        $student  = Student::find($id) ;
        $student->delete() ;
        return  redirect()->back()->with('success'  ,  'تم حذف  الطالب  بنجاح')  ;

    }
}
