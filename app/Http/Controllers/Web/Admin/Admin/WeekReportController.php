<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\{EductionMethod,
    EductionOutputMap,
    Innvoice,
    Matarial,
    MokrrerContent,
    Taqweem,
    TeachingOutput,
    TeachingOutputWeek,
    MokrrerContentWeek,
    EductionMethodWeek,
    InnvoiceWeek,
    TaqweemWeek};
use App\Traits\ResponseJson;

class WeekReportController extends Controller
{
    use  ResponseJson;
    public function weekreport_content($matarial_id , $week_number = null  , $active = null ,  $eduction_type = null )
    {

        $matarial  = Matarial::where('id' ,$matarial_id)->first() ;
        //نواتج تعلم المقرر
        $eduction_outputs = TeachingOutput::where(['matarial_id' => $matarial_id ,'type' => $eduction_type])->get() ;
        // نواتج تعلم المقرر  فى الجدول
        $eduction_output_map = EductionOutputMap::with('teaching_output')->where(['matarial_id' => $matarial_id , 'main_type' => 'week_report' ,'type' => $eduction_type ,   'week_number' => $week_number] )->get() ;
        $mokrrer_contents = MokrrerContentWeek::where(['matarial_id' => $matarial_id , 'week_number' => $week_number])->get() ;
        $teaching_methods = EductionMethodWeek::where(['matarial_id' => $matarial_id , 'week_number' => $week_number])->get() ;

        $invoices = InnvoiceWeek::where(['matarial_id' => $matarial_id , 'week_number' => $week_number])->get() ;
        $taqweem  = TaqweemWeek::where(['matarial_id' => $matarial_id , 'week_number' => $week_number])->get() ;

        return view('admins.week-report.index', compact('eduction_outputs' ,'matarial' , 'mokrrer_contents'  ,'week_number' ,'teaching_methods' ,'taqweem' ,'invoices' ,'active' ,'eduction_type' ,'eduction_output_map'));

    }
}


