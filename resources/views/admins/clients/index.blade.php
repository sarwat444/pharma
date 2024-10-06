@extends('dashboard.layouts.app')

@push('title',__('dashboard.all admins'))

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
                    <div class="table-responsive">
                    <table id="datatable2" class="table table-bordered table-striped admins-datatable"  data-orderable="0" data-orderable_type="desc">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('dashboard.first_name')}}</th>
                            <th>{{__('dashboard.last_name')}}</th>
                            <th>{{__('dashboard.email')}}</th>
                            <th>{{__('dashboard.created_at')}}</th>
                            <th>{{__('dashboard.active')}}</th>
                            <th>{{__('dashboard.actions')}}</th>
                        </tr>
                        </thead>

                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{asset(ASSET_PATH.'/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset(ASSET_PATH.'/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset(ASSET_PATH.'/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset(ASSET_PATH.'/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    @include('dashboard.clients.scripts.datatable')
@endpush
