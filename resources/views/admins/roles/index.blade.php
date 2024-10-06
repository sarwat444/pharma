@extends('admins.layouts.app')

@push('title',__('dashboard.roles'))

@push('styles')
<link href="{{asset(ASSET_PATH.'/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}"
      rel="stylesheet" type="text/css"/>
<link href="{{asset(ASSET_PATH.'/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
      rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <button type="button" class="btn btn-primary waves-effect waves-light"
                                data-bs-toggle="modal" data-bs-target="#create-new-category">
                            <i class="bx bx-add-to-queue font-size-16 align-middle me-2"></i> اضاقة دور  جديد
                        </button>
                    </div>
                    <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-striped  dataTable" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>أسم الدور</th>
                                <th>التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($roles as $role)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $role->name }}</td>
                                <th>
                                    <i style="font-size: 16px" class="text-primary bx bx-edit-alt edit-role" data-role-id="{{$role->id}}"></i>
                                    <i style="font-size: 16px" class="bx bxs-brightness assign-permission-to-role text-info"
                                       data-role-id="{{$role->id}}"></i>
                                </th>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">لا يوجد بيانات </td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admins.roles.modals.new-role')
    @include('admins.roles.modals.edit-role')
    @include('admins.roles.modals.assign-permission-to-role')
@endsection

@push('scripts')
    @include('admins.roles.scripts.new-role')
    @include('admins.roles.scripts.edit-role')
    @include('admins.roles.scripts.update-role')
    @include('admins.roles.scripts.assign-permission-to-role')
    @include('admins.roles.scripts.update-role-permissions')
<script src="{{asset(ASSET_PATH.'/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset(ASSET_PATH.'/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script
    src="{{asset(ASSET_PATH.'/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script
    src="{{asset(ASSET_PATH.'/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<script>
    $('.dataTable').DataTable({
        searching:true,
        sorting:false,
        aLengthMenu: [
            [25, 50, 100, 200, -1],
            [25, 50, 100, 200, @if(app()->getLocale() == 'ar') "الكل" @else "All" @endif]
    ],
    buttons: [

        {
            extend: 'collection',
            text: 'تصدير اكسل',
            buttons: [

                'excel',

            ]
        }
    ],
    @if(app()->getLocale() == 'ar')
    "language": {
        "sEmptyTable":     "ليست هناك بيانات متاحة في الجدول",
            "sLoadingRecords": "جارٍ التحميل...",
            "sProcessing":   "جارٍ التحميل...",
            "sLengthMenu":   "أظهر _MENU_ مدخلات",
            "sZeroRecords":  "لم يعثر على أية سجلات",
            "sInfo":         "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
            "sInfoEmpty":    "يعرض 0 إلى 0 من أصل 0 سجل",
            "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
            "sInfoPostFix":  "",
            "sSearch":       "ابحث :",
            "sUrl":          "",
            "oPaginate": {
            "sFirst":    "الأول",
                "sPrevious": "السابق",
                "sNext":     "التالي",
                "sLast":     "الأخير"
        },
        "oAria": {
            "sSortAscending":  ": تفعيل لترتيب العمود تصاعدياً",
                "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
        }
    }
    @endif


    });

</script>
@endpush



