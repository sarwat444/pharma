@extends('admins.layouts.app')

@push('title','أحصائيات الصيدلية')

@push('styles')
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@section('content')
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="card-title mb-3">أحصائيات الصيدلية</div>
                    <table class="table table-responsive">
                        <tbody>
                        <tr>
                            <td>أجمالى عدد الأصناف</td>
                            <td> {{$medicine_count}}  أصناف</td>
                        </tr>
                        <tr>
                            <td> الرصيد الحالى </td>
                            <td>  {{$total}}جم .</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/select2/js/select2.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/form-advanced.init.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/jquery.repeater/jquery.repeater.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/form-repeater.int.js')}}"></script>
@endpush
