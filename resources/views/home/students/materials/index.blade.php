@extends('home.layouts.app')
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
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex flex-wrap gap-2 mb-3">
                <button type="button" class="btn btn-primary waves-effect waves-light"
                        data-bs-toggle="modal" data-bs-target="#create-new-category">
                    <i class="bx bx-add-to-queue font-size-16 align-middle me-2"></i>تسجيل المقرر
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered  table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>كود المقرر </th>
                                <th>أسم المقرر</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($matarials as $matarial)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $matarial->matarial->code }}</td>
                                    <td>{{ $matarial->matarial->name }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" >لا يوجد بيانات مقررات أشتركت بها </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@include('home.students.materials.modals.store-modal')

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

    @include('home.students.materials.scripts.store')
    @include('home.students.materials.scripts.delete')
@endpush
