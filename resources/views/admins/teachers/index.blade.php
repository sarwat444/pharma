
@extends('admins.layouts.app')

@push('title',__('اعضاء هيئة التدريس'))

@push('styles')
    <link href="{{asset(ASSET_PATH.'/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset(ASSET_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <a href="{{route('dashboard.teachers.create' , $college_id)}}" class="btn btn-primary waves-effect waves-light">
                            <i class="bx bx-add-to-queue font-size-16 align-middle me-2"></i> اضافة عضو هيئة التدريس
                        </a>
                    </div>
                    <div class="table-responsive">
                    <table id="admins-datatable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الأسم</th>
                            <th>الأيميل</th>
                            <th>التحكم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as  $admin)
                            <tr>
                                <td>{{$admin->name}}</td>
                                <td>{{$admin->email}}</td>
                                <td>{{$admin->college->name}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('dashboard.admins.edit', $admin->id) }}" data-category-id="{{ $admin->id }}" class="text-muted font-size-20">
                                            <i class="bx bxs-edit"></i>
                                        </a>
                                        <form action="{{ route('dashboard.admins.destroy', $admin->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <a class="text-muted font-size-20 confirm-delete"><i class="bx bx-trash"></i></a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admins.admins.modals.assign-roles-permissions')
    @include('admins.admins.modals.edit-user')
@endsection

@push('scripts')
    <script src="{{asset(ASSET_PATH.'/assets/admin/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset(ASSET_PATH.'/assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script
        src="{{asset(ASSET_PATH.'/assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script
        src="{{asset(ASSET_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    @include('admins.admins.scripts.datatable')
    @include('admins.admins.scripts.assign-roles-permissions')

    <script>

        $('#form-assign-roles-permissions').on('submit', function (event) {
            event.preventDefault();
            $(this).find(".spinner-border").removeClass('d-none');
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize(),
                success: function (response) {
                    $(".spinner-border").addClass('d-none');
                    location.reload();
                    toast(response.type,response.message);
                },
                error: function (response) {
                    $(".spinner-border").addClass('d-none');
                    $.each(response.responseJSON.errors, function (key, value) {
                        toast("error", value[0]);
                    });
                },
            });
        });
    </script>

    @include('admins.admins.scripts.new-user')
    @include('admins.admins.scripts.edit-user')
    @include('admins.admins.scripts.update-user')

@endpush
