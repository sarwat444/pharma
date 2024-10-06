@php
    $currentRoute = Route::currentRouteName();
@endphp
<div class="d-flex flex-wrap gap-2 mb-3 output_sidebar">
    <a class="{{ $currentRoute == 'dashboard.mind.show' ? 'active' : '' }} btn btn-primary waves-effect waves-light" href="{{ route('dashboard.mind.show', $program->id) }}"> توصيف  المقرر  </a>
    <a class="{{ $currentRoute == 'dashboard.mind.show' ? 'active' : '' }} btn btn-primary waves-effect waves-light" href="{{ route('dashboard.mind.show', $program->id) }}">   التقرير الأسبوعى   </a>
</div>

