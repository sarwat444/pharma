@php
    $currentRoute = Route::currentRouteName();
    $currentWeek = request()->segment(5); // Assuming the week number is the 5th segment in the URL
@endphp
<ul class="sidebar-list">
    @for ($week = 1; $week <= 14; $week++)
        <li class="{{ $currentWeek == $week ? 'active' : '' }}">
            <a href="{{ route('dashboard.matarials.matraialmap_content', ['matarial_id' => $matarial->id, 'week_id' => $week , 'active' => 1 ,  'eduction_type' => 1]) }}">الأسبوع {{ $week }}</a>
        </li>
    @endfor
</ul>

