@extends('admins.layouts.app')
@push('title','خريطة المنهج')
@push('styles')
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- DataTables -->
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admins.includes.matarial_description_sidebar')
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="card">
                <div class="card-body">
                    @include('admins.includes.weeks')
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    @include('admins.includes.matarial_map_sidebar')
                    <div class="tab-content p-3 text-muted">
                        <div class="tab-pane @if(!empty($active) && $active == 1) active @endif" id="home1" role="tabpanel">
                                @include('admins.material-map.eduction_output.index')
                        </div>
                        <div class="tab-pane @if(!empty($active) && $active == 2) active @endif" id="profile1" role="tabpanel">
                                @include('admins.material-map.mokrrer_contents.index')
                        </div>
                        <div class="tab-pane @if(!empty($active) && $active == 3) active @endif" id="messages1" role="tabpanel">
                            <p class="mb-0">
                                @include('admins.material-map.eduction_methods.index')
                            </p>
                        </div>
                        <div class="tab-pane @if(!empty($active) && $active == 4) active @endif" id="settings1" role="tabpanel">
                            <p class="mb-0">
                                @include('admins.material-map.taqweem.index')
                            </p>
                        </div>
                        <div class="tab-pane @if(!empty($active) && $active == 5) active @endif" id="innvoice" role="tabpanel">
                            <p class="mb-0">
                                @include('admins.material-map.innvoices.index')
                            </p>
                        </div>


                    </div>

                </div>
            </div>

        </div>
    </div>


    @include('admins.material-map.eduction_output.modals.store-modal')
    @include('admins.material-map.eduction_output.modals.edit-modal')

    @include('admins.material-map.eduction_methods.modals.store-modal')
    @include('admins.material-map.eduction_methods.modals.edit-modal')

    @include('admins.material-map.mokrrer_contents.modals.store-modal')
    @include('admins.material-map.mokrrer_contents.modals.edit-modal')

    @include('admins.material-map.taqweem.modals.store-modal')
    @include('admins.material-map.taqweem.modals.edit-modal')

    @include('admins.material-map.innvoices.modals.store-modal')
    @include('admins.material-map.innvoices.modals.edit-modal')

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


    @include('admins.material-map.eduction_output.scripts.store')
    @include('admins.material-map.eduction_output.scripts.delete')
    @include('admins.material-map.eduction_output.scripts.edit')

    @include('admins.material-map.eduction_methods.scripts.store')
    @include('admins.material-map.eduction_methods.scripts.delete')
    @include('admins.material-map.eduction_methods.scripts.edit')

    @include('admins.material-map.mokrrer_contents.scripts.store')
    @include('admins.material-map.mokrrer_contents.scripts.delete')
    @include('admins.material-map.mokrrer_contents.scripts.edit')

    @include('admins.material-map.taqweem.scripts.store')
    @include('admins.material-map.taqweem.scripts.delete')
    @include('admins.material-map.taqweem.scripts.edit')


    @include('admins.material-map.innvoices.scripts.store')
    @include('admins.material-map.innvoices.scripts.delete')
    @include('admins.material-map.innvoices.scripts.edit')
   //اساليب  التقويم
    <script>
        $(document).ready(function (){
            $('.active').on('change', function (){
                var id = $(this).data('id');
                if ($(this).prop('checked')) {
                    $.ajax({
                        url: '{{ route('dashboard.output_eduction.change_eduction_methods_active') }}',
                        method: 'POST',
                        data: {
                            'id': id,
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            location.reload();
                        },
                        error: function (response) {
                            toast('error', 'An error occurred');
                        }
                    });
                }
            });
        });
    </script>
 //طرق  التعليم  والتعلم

    <script>
        $(document).ready(function (){
            $('.active2').on('change', function (){
                var id = $(this).data('id');
                if ($(this).prop('checked')) {
                    $.ajax({
                        url: '{{ route('dashboard.output_eduction.change_taqweem_active') }}',
                        method: 'POST',
                        data: {
                            'id': id,
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            location.reload();
                        },
                        error: function (response) {
                            toast('error', 'An error occurred');
                        }
                    });
                }
            });
        });
    </script>

@endpush
