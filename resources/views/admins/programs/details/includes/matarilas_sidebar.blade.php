@php
    $currentRoute = Route::currentRouteName();
@endphp
<div class="d-flex flex-wrap gap-2 mb-3 output_sidebar">
    <a class="{{ url()->current() == route('dashboard.matarilas.type', ['program_id' => $program->id, 'type' => 0]) ? 'active' : '' }} btn btn-primary waves-effect waves-light" href="{{ route('dashboard.matarilas.type', ['program_id' => $program->id, 'type' => 0]) }}">
        المقرر الألزامى
    </a>
    <a class="{{ url()->current() == route('dashboard.matarilas.type', ['program_id' => $program->id, 'type' => 1]) ? 'active' : '' }} btn btn-primary waves-effect waves-light" href="{{ route('dashboard.matarilas.type', ['program_id' => $program->id, 'type' => 1]) }}">
        المقرر الأنتقائي
    </a>
    <a class="{{ url()->current() == route('dashboard.matarilas.type', ['program_id' => $program->id, 'type' => 2]) ? 'active' : '' }} btn btn-primary waves-effect waves-light" href="{{ route('dashboard.matarilas.type', ['program_id' => $program->id, 'type' => 2]) }}">
        المقرر الأختياري
    </a>

</div>
