<?php

namespace App\Http\Controllers\Web\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentMatarial ;
use App\Models\Matarial ;

class MaterialsController extends Controller
{
    public function materials()
    {
        $student =  Auth::guard('student')->user() ;
        $matarials  = StudentMatarial::with('matarial' , 'student')->where('student_id' ,  $student->id)->get() ;
        $all_matarials  = Matarial::get() ;
        return view('home.students.materials.index' , compact('student' , 'matarials' , 'all_matarials')) ;
    }
    public function store(Request $request)
    {
        $request->validate([
            'matarial_id' => 'required'
        ]);

        $student = Auth::guard('student')->user();

        $exists = StudentMatarial::where([
            'matarial_id' => $request->matarial_id,
            'student_id'  => $student->id
        ])->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'تم أضافه المقرر من قبل');
        }

        StudentMatarial::create([
            'matarial_id' => $request->matarial_id,
            'student_id'  => $student->id
        ]);

        return redirect()->back()->with('success', 'تم أضافه المقرر بنجاح');
    }

}
