<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\EductionMethod;
use App\Models\EductionOutputMap;
use App\Models\Innvoice;
use App\Models\Matarial;
use App\Models\MatarialMap;
use App\Models\MokrrerContent;
use App\Models\Taqweem;
use App\Models\TeachingOutput;
use App\Traits\ResponseJson;

class MatarialMapController extends Controller
{
    use  ResponseJson ;

    public function __construct(private readonly MatarialMap $MatarialMapModel)
    {}
    public  function matraialmap_content($matarial_id , $week_number = null  , $active = null ,  $eduction_type = null )
    {
         $matarial  = Matarial::where('id' ,$matarial_id)->first() ;
         //نواتج تعلم المقرر
         $eduction_outputs = TeachingOutput::where(['matarial_id' => $matarial_id ,'type' => $eduction_type])->get() ;

        // نواتج تعلم المقرر  فى الجدول
         $eduction_output_map = EductionOutputMap::with('teaching_output')->where(['matarial_id' => $matarial_id , 'main_type' => 'map' ,'type' => $eduction_type ,   'week_number' => $week_number] )->get() ;
         $mokrrer_contents = MokrrerContent::where(['matarial_id' => $matarial_id , 'week_number' => $week_number])->get() ;
         $teaching_methods = EductionMethod::where(['matarial_id' => $matarial_id , 'week_number' => $week_number])->get() ;

         $invoices = Innvoice::where(['matarial_id' => $matarial_id , 'week_number' => $week_number])->get() ;
         $taqweem  = Taqweem::where(['matarial_id' => $matarial_id , 'week_number' => $week_number])->get() ;
         return view('admins.material-map.index', compact('eduction_outputs' ,'matarial' , 'mokrrer_contents'  ,'week_number' ,'teaching_methods' ,'taqweem' ,'invoices' ,'active' ,'eduction_type' ,'eduction_output_map'));

    }

}
