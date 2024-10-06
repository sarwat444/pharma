
@extends('admins.layouts.app')

@push('title',__('admins.all admins'))

@push('styles')
    <link href="{{asset(ASSET_PATH.'/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset(ASSET_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset(ASSET_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"
          type="text/css"/>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <a href="{{route('dashboard.rating.create')}}" class="btn btn-primary waves-effect waves-light">
                            <i class="bx bx-add-to-queue font-size-16 align-middle me-2"></i> اضافة أعضاء التحكيم
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
                        @foreach($RatingMembers as  $member)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$member->name}}</td>
                                <td>{{$member->email}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('dashboard.rating.edit', $member->id) }}" data-category-id="{{ $member->id }}" class="text-muted font-size-20">
                                            <i class="bx bxs-edit"></i>
                                        </a>
                                        <form action="{{ route('dashboard.rating.destroy', $member->id) }}" method="POST">
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

@endsection

@push('scripts')
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/sweet-alerts.init.js')}}"></script>
    <script src="{{asset(ASSET_PATH.'/assets/admin/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset(ASSET_PATH.'/assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script
        src="{{asset(ASSET_PATH.'/assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script
        src="{{asset(ASSET_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    @include('admins.admins.scripts.datatable')
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

    @include('admins.rating_members.scripts.delete')
@endpush
