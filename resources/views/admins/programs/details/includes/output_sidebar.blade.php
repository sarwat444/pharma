@php
    $currentRoute = Route::currentRouteName();
@endphp
<div class="d-flex flex-wrap gap-2 mb-3 output_sidebar">
    <a class="{{ $currentRoute == 'dashboard.mind.show' ? 'active' : '' }} btn btn-primary waves-effect waves-light" href="{{ route('dashboard.mind.show', $program->id) }}"> القدرات الذهنية </a>
    <a class="{{ $currentRoute == 'dashboard.Knowledge.show' ? 'active' : '' }} btn btn-primary waves-effect waves-light" href="{{ route('dashboard.Knowledge.show', $program->id) }}">  المعرفة والفهم </a>
    <a class="{{ $currentRoute == 'dashboard.workskills.show' ? 'active' : '' }} btn btn-primary waves-effect waves-light" href="{{ route('dashboard.workskills.show', $program->id) }}">  مهارات مهنيه وعلمية </a>
    <a class="{{ $currentRoute == 'dashboard.publicSkills.show' ? 'active' : '' }} btn btn-primary waves-effect waves-light" href="{{ route('dashboard.publicSkills.show', $program->id) }}">  مهارات  عامة </a>
    <a class="{{ $currentRoute == 'dashboard.standers.show' ? 'active' : '' }} btn btn-primary waves-effect waves-light" href="{{ route('dashboard.standers.show', $program->id) }}"> المعايير الأكاديمية للبرامج  </a>
    <a class="{{ $currentRoute == 'dashboard.references.show' ? 'active' : '' }} btn btn-primary waves-effect waves-light" href="{{ route('dashboard.references.show', $program->id) }}">  العلامات المرجعية  </a>
    <a class="{{ $currentRoute == 'dashboard.structures.show' ? 'active' : '' }} btn btn-primary waves-effect waves-light" href="{{ route('dashboard.structures.show', $program->id) }}"> هيكل مكونات البرنامج  </a>
</div>

