<div class="d-flex flex-wrap gap-2 mb-3 output_sidebar">
    <a class="@if($active == 1)  active  @endif btn btn-primary waves-effect waves-light" href="{{ route('dashboard.matarials.weekreport_content', ['matarial_id' => $matarial->id, 'week_id' => $week_number , 'active' => 1 , 'eduction_type' => 1]) }}">  نواتج التعلم المستهدفة   </a>
    <a class="@if($active == 2)  active  @endif btn btn-primary waves-effect waves-light" href="{{ route('dashboard.matarials.weekreport_content', ['matarial_id' => $matarial->id, 'week_id' => $week_number , 'active' => 2]) }}">  محتوى المقرر   </a>
    <a class="@if($active == 3)  active  @endif btn btn-primary waves-effect waves-light" href="{{ route('dashboard.matarials.weekreport_content', ['matarial_id' => $matarial->id, 'week_id' => $week_number , 'active' => 3]) }}">     طرق التعليم والتعلم </a>
    <a class="@if($active == 4)  active  @endif btn btn-primary waves-effect waves-light" href="{{ route('dashboard.matarials.weekreport_content', ['matarial_id' => $matarial->id, 'week_id' => $week_number , 'active' => 4] ) }}">    أساليب التقويم  </a>
    <a class="@if($active == 5)  active  @endif btn btn-primary waves-effect waves-light" href="{{ route('dashboard.matarials.weekreport_content', ['matarial_id' => $matarial->id, 'week_id' => $week_number , 'active' => 5]) }}">    الأدلة والشواهد </a>
</div>




