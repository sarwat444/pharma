@extends('admins.layouts.app')
@push('title','أضافه مدير نظام جديد')

@push('styles')
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/select2/css/select2.min.css')}}" rel="stylesheet"
          type="text/css"/>
@endpush
@section('content')
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="card-title mb-3">أضافة عضو التحكيم </div>

                    <form action="{{route('dashboard.rating_mokassya.store')}}" method="POST" id="store-new-user">
                        @csrf
                        <div class="mb-2">
                            <label for="name" class="col-form-label">أسم المحكم </label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="أسم المحكم"
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
                            <select class="form-control" name="college_id" id="college">
                                <option selected disabled>اختر الكليه</option>
                                @foreach($collegs as $college)
                                    <option value="{{ $college->id }}">{{ $college->name }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2">
                            <label for="mayear" class="col-form-label">المعايير البرمجية</label>
                            <select class="form-control" name="mayear_id" id="mayear">
                                <option selected disabled>برجاء اختيار المعيار</option>
                                <!-- Options will be dynamically loaded here -->
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
            $('#college').change(function() {
                var college_id = $(this).val();
                var mayearDropdown = $('#mayear');

                // Generate the correct URL for the AJAX request
                var route = "{{ route('dashboard.get_mayaears', ':college_id') }}";
                route = route.replace(':college_id', college_id);

                // Clear previous options
                mayearDropdown.empty();
                mayearDropdown.append('<option selected disabled>برجاء اختيار المعيار</option>');

                // Fetch mayaears based on the selected college
                $.ajax({
                    url: route,
                    type: 'GET',
                    success: function(response) {
                        $.each(response, function(index, mayear) {
                            mayearDropdown.append('<option value="'+mayear.id+'">'+mayear.name+'</option>');
                        });
                    },
                    error: function() {
                        alert('Failed to load mayaears. Please try again.');
                    }
                });
            });
        });
    </script>
@endpush
