@extends('admins.layouts.app')
@push('title', 'مستويات البرنامج')
@push('styles')
    <link href="{{ asset(PUBLIC_PATH . '/assets/admin/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset(PUBLIC_PATH .'/assets/admin/css/program_details.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset(PUBLIC_PATH .'/assets/admin/css/abilities.css') }}" rel="stylesheet" type="text/css"/>
    <style>
        .files
        {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .files li{
            display: inline-block;
        }
        .files li i{
            font-size: 20px;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    @include('admins.programs.details.includes.program_sidebar')
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card mb-2">
                <div class="card-header">
                    <div class="card-title mb-4">مستويات البرنامج :: <span class="text-danger">(pdf - word *)</span></div>
                </div>
                <div class="card-body">
                    <form id="levelsForm" action="{{ route('dashboard.store_levels') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <div class="row">
                                <label for="levels" class="col-md-3">مستويات البرنامج</label>
                                <div class="col-md-5">
                                    <input type="file" name="levels[]" class="form-control" multiple>
                                    <input type="hidden" name="program_id" class="form-control" value="{{$program->id}}" >
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-block btn-primary" type="submit"><i class="fa fa-save"></i> حفظ التغيرات</button>
                    </form>
                    <div id="filePreviews" class="mt-3">
                        <table class="table table-bordered table-striped">
                            <thead>
                               <th>الملفات</th>
                               <th>التحكم </th>
                            </thead>
                            <tbody>
                            @forelse($files as $file)
                                 <tr>
                                     <td><a href="{{ asset(PUBLIC_PATH .$file->file_path) }}"><i class="fa fa-file-alt"></i> {{$file->file_path}} </a></td>
                                    <td>
                                        <div class="btn-group">
                                            <form action="{{ route('dashboard.destory_level', $file->id) }}"
                                                  method="POST">@csrf @method('delete')
                                                <a class="text-muted font-size-20 confirm-delete"><i
                                                        class="bx bx-trash"></i></a>
                                            </form>
                                        </div>
                                    </td>
                                 </tr>
                                 @empty
                                لا يوجد ملفات لمستويات البرنامج
                            @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            @endsection
            @push('scripts')
                <script src="{{ asset(PUBLIC_PATH . '/assets/admin/libs/sweetalert2/sweetalert2.min.js') }}"></script>
                <script src="{{ asset(PUBLIC_PATH . '/assets/admin/js/pages/sweet-alerts.init.js') }}"></script>
            @include('admins.programs.details.levels.scripts.delete')
    @endpush

