@extends('admins.layouts.app')
@push('title','المقررات')
@push('styles')
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <!-- DataTables -->
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <!-- Responsive datatable examples -->
    <link
        href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
        rel="stylesheet" type="text/css"/>
    <style>
        .modal-body input
        {
            text-align: right;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    @include('admins.programs.details.includes.program_sidebar' , ['mokrr' => 1 ])
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="d-flex flex-wrap gap-2 mb-3">
                <button type="button" class="btn btn-primary waves-effect waves-light"
                        data-bs-toggle="modal" data-bs-target="#create-new-category">
                    <i class="bx bx-add-to-queue font-size-16 align-middle me-2"></i>أضافه المقرر
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    @include('admins.programs.details.includes.matarilas_sidebar')
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered  table-striped">
                            <thead>
                            <tr>
                                <th rowspan="2">كود / رقم المقرر</th>
                                <th rowspan="2">أسم المقرر</th>
                                <th rowspan="2">عدد الوحدات</th>
                                <th colspan="3">عدد الساعات الاسبوعيه</th>
                                <th rowspan="2">الفرقه والمستوى</th>
                                <th rowspan="2">الفصل الدراسي</th>
                                <th rowspan="2">التحكم</th>
                            </tr>
                            <tr>
                                <th>عملى</th>
                                <th>تمارين</th>
                                <th>نظرى</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($matarials as $matarial)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><p>{{ $matarial->name }}</p></td>
                                    <td>{{ $matarial->units }}</td>
                                    <td>{{ $matarial->amaly }}</td>
                                    <td>{{ $matarial->tamren }}</td>
                                    <td>{{ $matarial->nazary }}</td>
                                    <td>{{ $matarial->team }}</td>
                                    <td>{{ $matarial->section }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('dashboard.matarials.edit' , $matarial->id )}}"
                                               class="text-muted font-size-20 edit">
                                                <i class="bx bxs-edit"></i>
                                            </a>
                                            <form action="{{ route('dashboard.matarials.destroy', $matarial->id) }}"
                                                  method="POST">
                                                @csrf
                                                @method('delete')
                                                <a class="text-muted font-size-20 confirm-delete"><i
                                                        class="bx bx-trash"></i></a>
                                            </form>
                                            <a href="{{ route('dashboard.matarials_description.show', $matarial->id) }}"
                                               data-category-id="{{ $matarial->id}}" class="text-muted font-size-20 ">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">لا يوجد بيانات بالجدول</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admins.programs.details.matarial.modals.store-modal')
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

    @include('admins.programs.details.matarial.scripts.store')
    @include('admins.programs.details.matarial.scripts.delete')
@endpush
