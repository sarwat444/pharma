@php
    $currentRoute = Route::currentRouteName();
    $currentId = request()->route('question');
@endphp
<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5 class="mb-4">نواتج التعلم</h5>
        </div>
        <ul class="sidebar-list">
            @forelse($teaching_outputs as $output)
                <li  class="{{ $currentRoute == 'dashboard.questions.show' && $currentId == $output->id ? 'active' : '' }}">
                    <a href="{{ route('dashboard.questions.show', $output->id) }}">
                        {{ $output->name }}
                    </a>
                </li>
            @empty
                <span class="text-danger">لا يوجد نتائج التعلم</span>
            @endforelse
        </ul>
    </div>
</div>
