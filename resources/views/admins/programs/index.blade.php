@extends('admins.layouts.app')

@push('title','البرامج')
@push('styles')
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <!-- DataTables -->
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/assets/admin/css/collegs.css')}}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ $College->name }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"> {{ $College->name }} </a></li>
                    <li class="breadcrumb-item active">  البرامج </li>
                </ol>
            </div>

        </div>
    </div>
</div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @if(\Illuminate\Support\Facades\Auth::guard('admin')->user()->role == 'program_manager')
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <button type="button" class="btn btn-primary waves-effect waves-light"
                                    data-bs-toggle="modal" data-bs-target="#create-new-category">
                                <i class="bx bx-add-to-queue font-size-16 align-middle me-2"></i>أضافه برنامج جديد
                            </button>
                            <a href="{{route('dashboard.teachers.index' ,$College->id )}}" class="btn btn-primary waves-effect waves-light" >أعضاء هيئة التدريس  </a>
                            <a href="{{route('dashboard.MayearMokassy.show' ,$College->id )}}" class="btn btn-primary waves-effect waves-light" >المعايير المؤسسية </a>
                        </div>
                    @endif


                    <div class="table-responsive">
                      <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>البرنامج</th>
                            <th>التحكم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($programs  as $program)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td style="text-align: right"><a class="college_name" href="{{route('dashboard.progam_details' , $program->id )}}"> {{ $program->program }} </a> </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="javascript:void(0);" data-category-id="{{ $program->id }}"
                                           class="text-muted font-size-20 edit"><i class="bx bxs-edit"></i></a>
                                        <form action="{{ route('dashboard.programs.destroy', $program->id) }}"
                                              method="POST">@csrf @method('delete')
                                            <a class="text-muted font-size-20 confirm-delete"><i
                                                    class="bx bx-trash"></i></a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">لا يوجد بيانات بالجدول</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admins.programs.modals.store-modal')
    @include('admins.programs.modals.edit-modal')
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

    @include('admins.programs.scripts.store')
    @include('admins.programs.scripts.delete')
    @include('admins.programs.scripts.edit')
@endpush
