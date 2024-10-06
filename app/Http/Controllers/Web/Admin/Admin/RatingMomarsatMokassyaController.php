<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\MayearMokassy;
use App\Models\MokasherMokassy;
use App\Models\{MomarsaMokassya ,RatingMomarsaMokassy};
use App\Models\MomarsatFile;
use App\Models\MomarsatMokassyFile;
use App\Models\RatingMomarsa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingMomarsatMokassyaController extends Controller
{
    public function login()
    {
        return view('admins.rating_mokassy_members.auth.login') ;
    }
    public  function ratingLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if(Auth::guard('ratingMokassayMember')->attempt($credentials)) {
            $college_id =  Auth::guard('ratingMokassayMember')->user()->college_id ;
            return  redirect()->intended(route('ratingmokassy.mayears' , $college_id)) ;

        }
        else {
            return view('admins.rating_mokassy_members.auth.login')->with('error', 'Invalid credentials');
        }
    }
    public  function logout()
    {
        Auth::logout();
        return redirect()->intended(route('ratingMokassyLogin')) ;
    }

    //المعايير المؤسسية
    public function mayer($program_id)
    {
        $mayear_id  = Auth::guard('ratingMokassayMember')->user()->mayear_id ;
        $college  = MayearMokassy::with('college')->find($mayear_id) ;
        $myears = MayearMokassy::with('college')->withCount('mokashers')->where('id' , $mayear_id)->get();
        return view('admins.rating_mokassy_momarsa.mayears', compact('myears' ,'college'));
    }

    //المؤشرات
    public function mokashers($mayer_id = null)
    {
        $mayer = MayearMokassy::find($mayer_id);
        $mokashert = MokasherMokassy::withCount('momarsat')->where('mayear_mokassy_id', $mayer_id)->get();
        return view('admins.rating_mokassy_momarsa.mokashers', compact('mokashert'  ,'mayer'));
    }
    //الممارسات
    public function momarsat($mokasher_id): \Illuminate\View\View
    {
        $mokasher = MokasherMokassy::with('mayer')->find($mokasher_id);
        $Momarsas = MomarsaMokassya::withCount('files')->where('mokasher_id' , $mokasher_id)->get();
        return view('admins.rating_mokassy_momarsa.momarsat', compact('Momarsas' , 'mokasher'));
    }
    //ملفات الممارسه

    public function momarsa_files($momarsa_id): \Illuminate\View\View
    {
        $momarsa = MomarsaMokassya::find($momarsa_id);
        $MomarsatFiles = MomarsatMokassyFile::where('momarsa_id' ,$momarsa_id)->get();
        return view('admins.rating_mokassy_momarsa.momarsat_files', compact('MomarsatFiles' , 'momarsa'));
    }

    public function rating_momarsat($momarsa_id)
    {
        $momarsa = MomarsaMokassya::find($momarsa_id) ;
        $rating = RatingMomarsaMokassy::where('momarsa_id',$momarsa_id)->first();
        return view('admins.rating_mokassy_momarsa.store-rating-momarsa' ,compact('momarsa' , 'rating')) ;
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

        $rating = RatingMomarsaMokassy::where('momarsa_id', $request->momarsa_id)->first();

        if ($rating) {
            // Update the existing rating
            $rating->update([
                'rate' => $validatedData['rate'],
                'notes' => $validatedData['notes'],
            ]);
        } else {
            // Create a new rating
            RatingMomarsaMokassy::create([
                'rate' => $validatedData['rate'],
                'momarsa_id' => $validatedData['momarsa_id'],
                'notes' => $validatedData['notes'],
            ]);
        }
        return redirect()->back()->with('success' , 'تم وضع التقييم بنجاح');
    }

}
