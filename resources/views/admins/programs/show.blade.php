@extends('admins.layouts.app')
@push('title','المعلومات الأساسية')
@push('styles')
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/css/program_details.css')}}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ $program->program }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);"> {{ $program->program }} </a></li>
                        <li class="breadcrumb-item active"> البرامج</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    @include('admins.programs.details.includes.program_sidebar')
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <div class="card-title" style="float: right">معلومات أساسية عن البرنامج ::</div>
                    <a href="{{route('dashboard.program.print_details' , $program->id)}}" class="btn btn-primary" style="float: left">  التقرير الكامل للبرنامج </a>
                </div>
                <div class="card-body">
                    <form action="{{route('dashboard.program.store_details')}}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <div class="row">
                                <label for="name" class="col-md-3"> أسم البرنامج </label>
                                <div class="col-md-9">
                                    <input type="hidden" class="form-control" name="program_id"
                                           value="{{$program->id}}">
                                    <input type="text" class="form-control" name="program" placeholder="أسم البرنامج "
                                           value="{{$program->program ?? ''}}"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="row">
                                <label for="name" class="col-md-3"> طبيعة البرنامج </label>
                                <div class="col-md-9">
                                    <select class="form-control" name="type">
                                        <option value="0" @if($program->type == 0) selected @endif >أحادى</option>
                                        <option value="1" @if($program->type == 1) selected @endif >ثنائي</option>
                                        <option value="2" @if($program->type == 2) selected @endif >مشترك</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="row">
                                <label for="section" class="col-md-3">القسم المسؤل عن البرنامج</label>
                                <div class="col-md-9">
                                    <input class="form-control" name="section" placeholder="القسم المسؤل عن البرنامج "
                                           value="{{$program->section ?? ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="row">
                                <label for="name" class="col-md-3">تاريخ أقرار البرنامج </label>
                                <div class="col-md-9">
                                    <input type="date" class="form-control" name="added_date"
                                           placeholder="تاريخ أقرار البرنامج"
                                           value="{{ $program->added_date ? $program->added_date->format('Y-m-d') : '' }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-block btn btn-primary"><i class="fa fa-save"></i> حفظ
                            التغيرات
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/sweet-alerts.init.js')}}"></script>
@endpush

