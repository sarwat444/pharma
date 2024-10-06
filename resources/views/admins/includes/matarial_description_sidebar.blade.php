@php
    $currentRoute = Route::currentRouteName();
@endphp
<div class="d-flex flex-wrap gap-2 mb-3 output_sidebar">
    <a class="{{ $currentRoute == 'dashboard.matarials_description.show' ? 'active' : '' }} btn btn-primary waves-effect waves-light" href="{{ route('dashboard.matarials_description.show', $matarial->id) }}"> توصيف  المقرر  </a>
    <a class="{{ $currentRoute == 'dashboard.output_eduction.type' ? 'active' : '' }} btn btn-primary waves-effect waves-light" href="{{ route('dashboard.output_eduction.type', ['matarial_id' => $matarial->id ,  'type' => 1 ]) }}">  نواتج التعلم  </a>
    <a class="{{ $currentRoute == 'dashboard.matarials.matraialmap_content' ? 'active' : '' }} btn btn-primary waves-effect waves-light" href="{{ route('dashboard.matarials.matraialmap_content' , ['matarial_id' => $matarial->id , 'week_id' => 1 , 'active' => 1 , 'eduction_type' => 1 ]) }}">    خريطه المنهج    </a>
    <a class="{{ $currentRoute == 'dashboard.matarials.weekreport_content' ? 'active' : '' }} btn btn-primary waves-effect waves-light" href="{{ route('dashboard.matarials.weekreport_content' , ['matarial_id' => $matarial->id , 'week_id' => 1 , 'active' => 1  , 'eduction_type' => 1 ]) }}">  التقرير الأسبوعى   </a>
    <a class="
   @if( $currentRoute == 'dashboard.output_education_questions' )
       active
           @elseif(isset($active) && $active === 'mekyas_talem')
       active
      @else
         ''
   @endif
       btn btn-primary waves-effect waves-light" href="{{ route('dashboard.output_education_questions', $matarial->id) }}"> قياس نواتج التعلم </a>

    <a class="{{ $currentRoute == 'dashboard.outputs_education_report' ? 'active' : '' }} btn btn-primary waves-effect waves-light" href="{{ route('dashboard.outputs_education_report', $matarial->id) }}"> تقرير نواتج التعلم </a>
    <a class="{{ $currentRoute == 'dashboard.students.show' ? 'active' : '' }} btn btn-primary waves-effect waves-light" href="{{ route('dashboard.students.show', $matarial->id) }}"> الطلاب </a>
    <a class="{{ $currentRoute == 'dashboard.survey.show' ? 'active' : '' }} btn btn-primary waves-effect waves-light" href="{{ route('dashboard.survey.show', $matarial->id) }}"> الأستبيانات  </a>
    <a class="{{ $currentRoute == 'dashboard.matrial.connect_output' ? 'active' : '' }} btn btn-primary waves-effect waves-light" href="{{ route('dashboard.matrial.connect_output', $matarial->id) }}"> ربط نواتج تعلم البرنامج بنواتج المقرر</a>
    <a class="{{ $currentRoute == 'dashboard.mokrr.print_details' ? 'active' : '' }} btn btn-primary waves-effect waves-light" href="{{ route('dashboard.mokrr.print_details', $matarial->id) }}"> طباعه توصيف  المقرر  </a>
</div>

