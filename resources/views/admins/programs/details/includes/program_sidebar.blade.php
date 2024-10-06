@php
    $currentRoute = Route::currentRouteName();
@endphp
<ul class="sidebar-list">
    @if(\Illuminate\Support\Facades\Auth::guard('admin')->user()->role == 'program_manager')
        <li class="{{ $currentRoute == 'dashboard.progam_details' ? 'active' : '' }}"><a
                href="{{ route('dashboard.progam_details', $program->id) }}"> <i class="fa fa-angle-left"> </i> معلومات
                أساسية </a></li>


        <li class="{{ $currentRoute == 'dashboard.goals.show' ? 'active' : '' }}"><a
                href="{{ route('dashboard.goals.show', $program->id) }}"> <i class="fa fa-angle-left"> </i> الأهداف
                العامه
            </a></li>
        <li class="@if( $currentRoute == 'dashboard.mind.show')
                active
                @elseif( !empty($output) &&  $output == 1 )
                active
                @else
                ''
                @endif
                "><a href="{{ route('dashboard.mind.show', $program->id) }}"> <i class="fa fa-angle-left"> </i> المخرجات
                التعليميه </a></li>
        <li class="{{ $currentRoute == 'dashboard.program.levels' ? 'active' : '' }}"><a
                href="{{ route('dashboard.program.levels', $program->id) }}"> <i class="fa fa-angle-left"> </i> مستويات
                البرنامج </a></li>
        <li class="


         @if( url()->current() == route('dashboard.matarilas.type', ['program_id' => $program->id, 'type' => 0]) ? 'active' : '') active  @elseif( !empty($mokrr) &&  $mokrr == 1 ) active  @else  ''  @endif  ">

    @endif

            <a href="{{ route('dashboard.matarilas.type', ['program_id' => $program->id, 'type' => 0]) }}"> <i
                    class="fa fa-angle-left"> </i> مقررات البرنامج </a></li>

    @if(\Illuminate\Support\Facades\Auth::guard('admin')->user()->role == 'program_manager')

            <li class="{{ $currentRoute == 'dashboard.input_report' ? 'active' : 'report_input' }}"><a
                    href="{{ route('dashboard.input_report', $program->id) }}"> <i class="fa fa-angle-left"> </i> تقرير
                    مدخلات
                    المقررات
                </a>
            </li>
            <li class="{{ $currentRoute == 'dashboard.myear.show' ? 'active' : '' }}"><a href="{{ route('dashboard.myear.show', $program->id) }}"> <i class="fa fa-angle-left"> </i> المعايير البرمجية </a></li>

            <li class="{{ $currentRoute == 'dashboard.program_outputs_education_report' ? 'active' : '' }}"><a href="{{ route('dashboard.program_outputs_education_report', $program->id) }}"> <i class="fa fa-angle-left"> </i> قياس نواتج التعلم على مستوى البرنامج </a></li>
            <li class="{{ $currentRoute == 'dashboard.program.showReport' ? 'active' : '' }}"><a href="{{ route('dashboard.program.showReport', $program->id) }}"> <i class="fa fa-angle-left"> </i> تقرير ربط  نواتج المقررات بالبرنامج  </a></li>


     @endif

</ul>

