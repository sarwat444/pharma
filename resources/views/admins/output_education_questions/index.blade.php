@extends('admins.layouts.app')

@push('title',__('admin-dashboard.medicines'))

@push('styles')
    <link href="{{asset('/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link
        href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
        rel="stylesheet" type="text/css"/>
    <link href="{{asset('/assets/admin/css/collegs.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            @include('admins.includes.matarial_description_sidebar')
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            @include('admins.includes.output_education_items')
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <p>برجاء الضغط على ناتج التعلم لعرض الاسئله وربطها بالناتج </p>
                </div>
            </div>
        </div>
    </div>
    @include('admins.medicines.modals.store-modal')
    @include('admins.medicines.modals.edit-modal')
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
    @include('admins.medicines.scripts.store')
    @include('admins.medicines.scripts.delete')
    @include('admins.medicines.scripts.edit')
@endpush
