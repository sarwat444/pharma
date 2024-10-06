@php
    $currentRoute = Route::currentRouteName();
@endphp
<div class="d-flex flex-wrap gap-2 mb-3 output_sidebar">
    <a class="@if($eduction_type == 1)  active  @endif btn btn-primary waves-effect waves-light" href="{{ route('dashboard.matarials.matraialmap_content', ['matarial_id' => $matarial->id, 'week_id' => $week_number , 'active' => 1 , 'eduction_type' => 1 ]) }}">
        المعلومات والمفاهيم
    </a>
    <a  class="@if($eduction_type == 2)  active  @endif btn btn-primary waves-effect waves-light" href="{{ route('dashboard.matarials.matraialmap_content', ['matarial_id' => $matarial->id, 'week_id' => $week_number , 'active' => 1 , 'eduction_type' => 2]) }}">
        المهارات الذهنية
    </a>
    <a  class="@if($eduction_type == 3)  active  @endif btn btn-primary waves-effect waves-light" href="{{ route('dashboard.matarials.matraialmap_content', ['matarial_id' => $matarial->id, 'week_id' => $week_number , 'active' => 1 , 'eduction_type' => 3]) }}">
        المهارات المهنية
    </a>
    <a class="@if($eduction_type == 4)  active  @endif btn btn-primary waves-effect waves-light" href="{{ route('dashboard.matarials.matraialmap_content', ['matarial_id' =>$matarial->id, 'week_id' => $week_number , 'active' => 1 , 'eduction_type' => 4]) }}">
        المهارات العامة
    </a>
</div>
