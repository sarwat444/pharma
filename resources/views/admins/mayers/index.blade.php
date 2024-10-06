@extends('admins.layouts.app')

@push('title','المعايير البرمجيه')

@push('styles')
    <link href="{{asset('/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"  type="text/css"/>
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"  type="text/css"/>
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/assets/admin/css/collegs.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@section('content')
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    @include('admins.programs.details.includes.program_sidebar')
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <button type="button" class="btn btn-primary waves-effect waves-light"
                                data-bs-toggle="modal" data-bs-target="#create-new-college">
                            <i class="bx bx-add-to-queue font-size-16 align-middle me-2"></i>أضافه معيار
                        </button>
                        <a href="{{route('dashboard.mayear_rating_report' ,   $program->id )}}" class="btn btn-primary waves-effect waves-light">
                            <i class="bx bx-add-to-queue font-size-16 align-middle me-2"></i>  تقرير المحكم للمعايير
                        </a>
                        <a href="{{route('dashboard.mayear_rating_files_report' ,   $program->id )}}"
                           class="btn btn-primary waves-effect waves-light">
                            تقرير أنجاز رفع الملفات
                        </a>
                    </div>
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>المعيار</th>
                            <th>عدد المؤشرات </th>
                            <th>التحكم </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($myears as $myear)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a  class="college_name" href="{{route('dashboard.mokasherat.show', $myear->id )}}">{{ $myear->name }}</a></td>
                                <td><span class="badge badge-pill badge-soft-primary font-size-12">{{ $myear->mokashers_count }}</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="javascript:void(0);" data-category-id="{{ $myear->id }}"
                                           class="text-muted font-size-20 edit"><i class="bx bxs-edit"></i></a>
                                        <form action="{{ route('dashboard.myear.destroy', $myear->id) }}"
                                              method="POST">@csrf @method('delete')
                                            <a class="text-muted font-size-20 confirm-delete"><i
                                                    class="bx bx-trash"></i></a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">لا يوجد معايير حاليه</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('admins.mayers.modals.store-modal')
    @include('admins.mayers.modals.edit-modal')
@endsection


@push('scripts')
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/sweet-alerts.init.js')}}"></script>
    <!-- Required datatable js -->
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Responsive examples -->
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <!-- Datatable init js -->
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/datatables.init.js')}}"></script>
    @include('admins.mayers.scripts.store')
    @include('admins.mayers.scripts.delete')
    @include('admins.mayers.scripts.edit')
@endpush
