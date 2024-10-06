@php
$college_id  = \Illuminate\Support\Facades\Auth::guard('ratingMokassayMember')->user()->college_id ;
@endphp
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu" style="margin-top:45px">
                <li>
                    <a href="{{ route('ratingmokassy.mayears' ,$college_id ) }}">
                        <i class='bx bx-list-ul'></i>
                        <span key="t-maps"> تقييم البرامج </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
