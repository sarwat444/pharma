<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mokasher;
use App\Models\Momarsa;
use App\Models\MomarsatFile;
use App\Models\Myear;
use App\Models\Program;
use App\Models\RatingMembers;
use App\Models\RatingMomarsa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingMomarsatController extends Controller
{
   // البرامج المقيمه
    public function login()
    {
        return view('admins.rating_members.auth.login') ;
    }
    public  function ratingLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if(Auth::guard('ratingMember')->attempt($credentials)) {
           return  redirect()->intended(route('rating.programs')) ;
        }
        else {
            return view('ratingLogin')->with('error', 'Invalid credentials');
        }
    }
    public  function logout()
    {
        Auth::logout();
        return redirect()->intended(route('ratingLogin')) ;
    }

   public function programs()
   {
       $program_id  = Auth::guard('ratingMember')->user()->program_id ;
       $programs = Program::where('id' ,$program_id)->withCount('mayears')->get();
       return view('admins.rating_momarsa.programs', compact('programs'));
   }
   //المعايير للبرنامج
    public function mayer($program_id)
    {
        $program = Program::find($program_id);
        $myears = Myear::withCount('mokashers')->where('program_id' , $program_id)->get();
        return view('admins.rating_momarsa.mayears', compact('myears' ,'program'));
    }
    //المؤشرات
    public function mokashers($mayer_id = null)
    {
        $mayer = Myear::with('program')->find($mayer_id);
        $program  = $mayer->program ;
        $mokashert = Mokasher::withCount('momarsat')->where('myear_id', $mayer_id)->get();
        return view('admins.rating_momarsa.mokashers', compact('mokashert' ,'program' ,'mayer'));
    }
    //الممارسات
    public function momarsat($mokasher_id): \Illuminate\View\View
    {
        $mokasher = Mokasher::with('mayer' , 'mayer.program')->find($mokasher_id);
        $program = $mokasher->mayer->program ;
        $Momarsas = Momarsa::withCount('files')->where('mokasher_id' , $mokasher_id)->get();
        return view('admins.rating_momarsa.momarsat', compact('Momarsas' , 'mokasher' ,'program'));
    }
    //ملفات الممارسه
    public function momarsa_files($momarsa_id): \Illuminate\View\View
    {
        $momarsa = Momarsa::with( 'mokasher.mayer.program')->find($momarsa_id);
        $program = $momarsa->mokasher->mayer->program ;
        $MomarsatFiles = MomarsatFile::where('momarsa_id' ,$momarsa_id )->get();
        return view('admins.rating_momarsa.momarsat_files', compact('MomarsatFiles' , 'momarsa' ,'program'));
    }
    public function rating_momarsat($momarsa_id)
    {
        $momarsa = Momarsa::find($momarsa_id) ;
        $rating = RatingMomarsa::where('momarsa_id',$momarsa_id)->first();
        return view('admins.rating_momarsa.store-rating-momarsa' ,compact('momarsa' , 'rating')) ;
    }
    public function store_momarse_rating(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'rate' => 'required', // Adjust min and max according to your rating system
            'momarsa_id' => 'required',
            'notes' => 'nullable|string'
        ]);

        // Check if a rating already exists for this momarsa

        $rating = RatingMomarsa::where('momarsa_id', $request->momarsa_id)->first();

        if ($rating) {
            // Update the existing rating
            $rating->update([
                'rate' => $validatedData['rate'],
                'notes' => $validatedData['notes'],
            ]);
        } else {
            // Create a new rating
            RatingMomarsa::create([
                'rate' => $validatedData['rate'],
                'momarsa_id' => $validatedData['momarsa_id'],
                'notes' => $validatedData['notes'],
            ]);
        }
        return redirect()->back()->with('success' , 'تم وضع التقييم بنجاح');
    }

}
