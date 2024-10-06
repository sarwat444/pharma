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

                    <form action="{{route('dashboard.rating.store')}}" method="POST" id="store-new-user">
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
                            <select class="form-control select2" name="college_id" id="college">
                                @foreach($collegs as $college)
                                    <option value="{{$college->id}}">{{$college->name}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="college" class="col-form-label">البرنامج </label>
                            <select class="form-control select2" name="program_id" id="college">
                                <option selected disabled> برجاء أختيار البرنامج  المحكم </option>
                                @foreach($programs  as $program)
                                    <option value="{{$program->id}}">{{$program->program}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="type" class="col-form-label">نوع المستخدم </label>
                            <select class="form-control" name="type" id="type">
                                <option selected disabled>  يرجى أختيار مدير يرنامج / مقيم ممارسات </option>
                                <option value="1">محكم برامج  </option>
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

@endpush
