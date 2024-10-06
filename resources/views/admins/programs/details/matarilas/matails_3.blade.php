@extends('admins.layouts.app')

@push('title', 'المقررات'))
@push('styles')
    <link href="{{ asset(PUBLIC_PATH . '/assets/admin/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <!-- DataTables -->
    <link href="{{ asset(PUBLIC_PATH . '/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link
        href="{{ asset(PUBLIC_PATH . '/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css"/>
    <!-- Responsive datatable examples -->
    <link
        href="{{ asset(PUBLIC_PATH . '/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css"/>
    <link href="{{ asset(PUBLIC_PATH.'/assets/admin/css/collegs.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset(PUBLIC_PATH.'/assets/admin/css/program_details.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset(PUBLIC_PATH.'/assets/admin/css/abilities.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    @include('admins.programs.details.includes.program_sidebar')
                </div>
            </div>
        </div>
        <div class="col-md-8">

            @include('admins.programs.details.includes.matarilas_sidebar')
            <div class="card">
                <div class="card-body">
                    <div class="card-title mb-3">المقرر الأختياري</div>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                                data-bs-target="#create-new-category">
                            <i class="bx bx-add-to-queue font-size-16 align-middle me-2"></i>أضافه مقرر جديد
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 table-striped">
                            <thead>
                            <tr>
                                <th>كود/رقم المقرر</th>
                                <th>أسم المقرر</th>
                                <th>عدد الوحدات</th>
                                <th>عدد الساعات الاسبوعيه</th>
                                <th>الفرقه والمستوى</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($matarilas  as $program)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td style="text-align: right"><a class="college_name"
                                                                     href="{{ route('dashboard.progam_details', $program->id) }}">
                                            {{ $program->program }} </a></td>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="javascript:void(0);" data-category-id="{{ $program->id }}"
                                               class="text-muted font-size-20 edit"><i class="bx bxs-edit"></i></a>
                                            <form action="{{ route('dashboard.matarilas.destroy', $program->id) }}"
                                                  method="POST">@csrf @method('delete')
                                                <a class="text-muted font-size-20 confirm-delete"><i
                                                        class="bx bx-trash"></i></a>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">لا يوجد مقررات</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection


@push('scripts')
    <script src="{{ asset(PUBLIC_PATH . '/assets/admin/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset(PUBLIC_PATH . '/assets/admin/js/pages/sweet-alerts.init.js') }}"></script>
    <!-- Required datatable js -->
    <script src="{{ asset(PUBLIC_PATH . '/assets/admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script
        src="{{ asset(PUBLIC_PATH . 'assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Responsive examples -->
    <script
        src="{{ asset(PUBLIC_PATH . '/assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script
        src="{{ asset(PUBLIC_PATH . '/assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}">
    </script>
    <!-- Datatable init js -->
    <script src="{{ asset(PUBLIC_PATH . '/assets/admin/js/pages/datatables.init.js') }}"></script>
@endpush
