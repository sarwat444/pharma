@php
    $currentRoute = Route::currentRouteName();
@endphp
<div class="d-flex flex-wrap gap-2 mb-3 output_sidebar">
    <a class="{{ url()->current() == route('dashboard.output_eduction.type', ['matarial_id' => $matarial->id, 'type' => 1]) ? 'active' : '' }} btn btn-primary waves-effect waves-light" href="{{ route('dashboard.output_eduction.type', ['matarial_id' => $matarial->id, 'type' => 1]) }}">
         المعلومات والمفاهيم
    </a>
    <a class="{{ url()->current() == route('dashboard.output_eduction.type', ['matarial_id' => $matarial->id, 'type' => 2]) ? 'active' : '' }} btn btn-primary waves-effect waves-light" href="{{ route('dashboard.output_eduction.type', ['matarial_id' => $matarial->id, 'type' => 2]) }}">
         المهارات الذهنية
    </a>
    <a class="{{ url()->current() == route('dashboard.output_eduction.type', ['matarial_id' => $matarial->id, 'type' => 3]) ? 'active' : '' }} btn btn-primary waves-effect waves-light" href="{{ route('dashboard.output_eduction.type', ['matarial_id' => $matarial->id, 'type' => 3]) }}">
        المهارات المهنية
    </a>
    <a class="{{ url()->current() == route('dashboard.output_eduction.type', ['matarial_id' => $matarial->id, 'type' => 4]) ? 'active' : '' }} btn btn-primary waves-effect waves-light" href="{{ route('dashboard.output_eduction.type', ['matarial_id' =>$matarial->id, 'type' => 4]) }}">
        المهارات العامة
    </a>
</div>
