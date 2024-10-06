@extends('admins.layouts.app')
@push('title','أضافه مسؤل معيار برمجى')

@push('styles')
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/select2/css/select2.min.css')}}" rel="stylesheet"
          type="text/css"/>
@endpush
@section('content')
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="card-title mb-3">أضافة عضو هيئة تدريس  </div>
                    <form action="{{route('dashboard.admins.store')}}" method="POST" id="store-new-user">
                        @csrf
                        <input type="hidden" name="type" value="3" >
                        <input type="hidden" name="college_id" value="{{$college_id}}">

                        <input type="hidden" name="role" value="teaching_manager">
                        <div class="mb-2">
                            <label for="name" class="col-form-label">أسم العضو </label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="أسم العضو"
                                   required>
                        </div>

                        <div class="mb-2">
                            <label for="email" class="col-form-label">الأيميل</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="الأيميل"
                                   required>
                        </div>

                        <div class="mb-2">
                            <label for="password" class="col-form-label">الباسورد</label>
                            <input type="password" name="password" class="form-control" id="password"
                                   placeholder="الباسورد" required>
                        </div>

                        <div class="mb-2">
                            <label for="college" class="col-form-label">البرامج </label>
                            <select class="form-control select2" name="program_id" id="college_select">
                                <option selected disabled>برجاء أختيار البرنامج </option>
                                @foreach($programs as $program)
                                    <option value="{{$program->id}}">{{$program->program}} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2">
                            <label for="major" class="col-form-label">المقرر</label>
                            <select class="form-control" name="matrial_id" id="matrial_select" required>
                                <option disabled> برجاء تحديد المقرر </option>
                            </select>
                        </div>

                        <div class="mb-2 text-center">
                            <div class="spinner-border text-primary m-1 d-none" role="status"><span
                                    class="sr-only"></span></div>
                        </div>

                        <div class="modal-footer" style="float: right">
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </form>
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
    <script>
        $(document).ready(function() {
            $('#college_select').on('change', function() {
                var program_id = $(this).val();

                if (program_id) {
                    // Make an AJAX request
                    $.ajax({
                        url: '{{route('dashboard.getMatrials')}}', // The route that returns the majors
                        type: 'GET',
                        data: { program_id: program_id },
                        success: function(data) {
                            $('#matrial_select').empty(); // Clear previous options
                            $('#matrial_select').append('<option selected disabled>برجاء تحديد المقرر</option>');

                            // Loop through the data and append new options
                            $.each(data, function(key, major) {
                                $('#matrial_select').append('<option value="' + major.id + '">' + major.name + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.log('Error: ' + error);
                        }
                    });
                } else {
                    $('#matrial_select').empty();
                    $('#matrial_select').append('<option selected disabled>برجاء تحديد المقرر</option>');
                }
            });
        });

    </script>

@endpush
