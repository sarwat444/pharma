<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu" style="margin-top:45px">
                <li>
                    <a href="{{route('home.materials')}}" class="waves-effect">
                        <i class="bx bx-chat"></i>
                        <span key="t-chat">المقررات</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="bx bxs-eraser"></i>
                        <span class="badge rounded-pill bg-danger float-end">{{ $matarials->count() ?? 0   }}</span>
                        <span key="t-forms">الأستبيانات</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @forelse($matarials as $matarial)
                              <li><a href="{{ route('home.matarials.survies' , $matarial->matarial->id )}}" key="t-form-elements">{{ $matarial->matarial->name }}</a></li>
                         @empty
                               <li><span class="badge badge-soft-danger">لا يوجد مقررات </span></li>
                         @endforelse
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
