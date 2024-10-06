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
                    <div class="card-title mb-3">أضافة مسؤل معيار مؤسسي   </div>
                    <form action="{{route('dashboard.admins.store')}}" method="POST" id="store-new-user">
                        @csrf
                        <input type="hidden" name="type" value="2" >
                        <div class="mb-2">
                            <label for="name" class="col-form-label">أسم المسؤل </label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="أسم المدير"
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
                            <label for="college" class="col-form-label">الكليه</label>
                            <select class="form-control select2" name="college_id" id="college_select">
                                <option selected disabled>برجاء أختيار الكلية </option>
                                @foreach($collegs as $college)
                                    <option value="{{$college->id}}">{{$college->name}} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2">
                            <label for="major" class="col-form-label">المعيار</label>
                            <select class="form-control" name="mayear_id" id="major_select" required>
                                <option disabled>برجاء تحديد المعيار</option>
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
                var college_id = $(this).val();

                if (college_id) {
                    // Make an AJAX request
                    $.ajax({
                        url: '{{route('dashboard.getMajorsMokassy')}}', // The route that returns the majors
                        type: 'GET',
                        data: { college_id: college_id },
                        success: function(data) {
                            $('#major_select').empty(); // Clear previous options
                            $('#major_select').append('<option selected disabled>برجاء تحديد المعيار</option>');

                            // Loop through the data and append new options
                            $.each(data, function(key, major) {
                                $('#major_select').append('<option value="' + major.id + '">' + major.name + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.log('Error: ' + error);
                        }
                    });
                } else {
                    $('#major_select').empty();
                    $('#major_select').append('<option selected disabled>برجاء تحديد المعيار</option>');
                }
            });
        });

    </script>

@endpush
