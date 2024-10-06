@extends('home.layouts.app')

@push('title','الأستبيانات')

@push('styles')
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link
        href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
        rel="stylesheet" type="text/css"/>
    <style>
        .share_btn
        {
            font-size: 12px;
            padding: 6px;
        }
        .disbled_btn
        {
            background-color: #ccc !important;
            border-color: #ccc !important; ;
        }
    </style>
@endpush
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100 text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الأستبيان</th>
                            <th>حاله الاستبيان</th>
                            <th>عدد المحاور</th>
                            <th>تم أنشاءه</th>
                            <th>التحكم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($survies as $survey)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $survey->name }}</td>
                                <td>
                                    @if($survey->status == 1)
                                        <span class="badge badge-soft-success">نشط</span>
                                    @else
                                        <span class="badge badge-soft-danger">غير نشط </span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-pill badge-soft-primary font-size-12">{{ $survey->categories->count() ?? '0' }}</span>
                                </td>
                                <td>{{$survey->created_at}}</td>
                                <td>
                                    @if($survey->status == 1 && !$survey->completed)
                                        <a href="{{ route('home.survey', $survey->id) }}" class="btn btn-primary">فتح الأستبيان</a>
                                    @elseif($survey->completed)
                                        <button class="btn btn-success" disabled>تم إكمال الأستبيان</button>
                                    @else
                                        <button class="btn btn-primary disbled_btn" disabled>فتح الأستبيان</button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">لا يوجد أستبيانات حاليه</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/sweet-alerts.init.js')}}"></script>
    <!-- Required datatable js -->
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script
        src="{{asset(PUBLIC_PATH.'assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Responsive examples -->
    <script
        src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script
        src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <!-- Datatable init js -->
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/datatables.init.js')}}"></script>
@endpush
