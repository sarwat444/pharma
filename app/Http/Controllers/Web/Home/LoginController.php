<?php

namespace App\Http\Controllers\Web\Home;

use App\Http\Controllers\Controller;
use App\Models\Matarial;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class LoginController extends Controller
{
    public function login()
    {
        return view('home.auth.login');
    }

    public function check_login(Request $request)
    {
         if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::guard('student')->user();
            return redirect()->intended(route('home.index')); // Correctly redirect to student dashboard
        } else {
            return redirect()->route('login')->withErrors(['msg' => 'Invalid credentials.']);
        }
    }
    public function register()
    {
        return view('home.auth.register');
    }

    public function index()
    {
         $student  = Auth::guard('student')->user() ;
         $matarials = Matarial::with('survey')->where('id' , $student->matarial_id)->get() ;
         return view('home.students.index' , compact('matarials')) ;
    }
    public  function Home_page()
    {
        return view('home.home') ;
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required' => 'الاسم بالكامل مطلوب',
            'class.required' => 'الفرقة مطلوبة',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.unique' => 'البريد الإلكتروني موجود مسبقاً',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'يجب أن تكون كلمة المرور 6 أحرف على الأقل',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق',
        ]);

        Student::create([
            'name' => $validatedData['name'],
            'class' => $validatedData['class'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);
        return redirect()->route('login')->with('success', 'تم التسجيل بنجاح، الرجاء تسجيل الدخول');
    }


}
