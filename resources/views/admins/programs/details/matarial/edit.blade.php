@extends('admins.layouts.app')
@push('title','تعديل بيانات المقرر')
@push('styles')
    <style>
        input[type="number"]
        {
            text-align: right;
        }
    </style>
@endpush
@section('content')
    <div class="card">

        <div class="card-body">
            <div class="card-title mb-3">تعديل بيانات المقرر </div>
            <form action="{{route('dashboard.matarials.update' , $mokrrer->id)}}" method="POST" >
                @method('PUT')
                @csrf

                <div class="mb-2">
                    <label for="code" class="col-form-label"> كود المقرر </label>
                    <input type="text" name="code" placeholder="كود المقرر" class="form-control" id="code" value="{{ $mokrrer->code }}" required>

                </div>


                <div class="mb-2">
                    <label for="type" class="col-form-label">نوع المقرر</label>
                    <select name="type" class="form-control">
                        <option value="0" {{ $mokrrer->type == 0 ? 'selected' : '' }}>ألزامى</option>
                        <option value="1" {{ $mokrrer->type == 1 ? 'selected' : '' }}>أنتقائي</option>
                        <option value="2" {{ $mokrrer->type == 2 ? 'selected' : '' }}>أختياري</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="name" class="col-form-label">أسم المقرر</label>
                    <input type="text" name="name" placeholder="أسم المقرر" class="form-control" id="name"
                           value="{{ $mokrrer->name }}" required>
                    <input type="hidden" name="program_id" value="{{ $program->id }}">
                </div>
                <div class="mb-2">
                    <label for="units" class="col-form-label">عدد الوحدات</label>
                    <input type="number" name="units" placeholder="عدد الوحدات" class="form-control" id="units"
                           value="{{ $mokrrer->units }}" required>
                </div>
                <div class="mb-2">
                    <label for="hours" class="col-form-label">عدد الساعات الأسبوعية</label>
                    <div class="row">
                        <div class="col">
                            <label for="nazary">نظري</label>
                            <input type="number" name="nazary" placeholder="نظري" class="form-control" id="nazary"
                                   value="{{ $mokrrer->nazary }}" required>
                        </div>
                        <div class="col">
                            <label for="tamren">تمارين</label>
                            <input type="number" name="tamren" placeholder="تمارين" class="form-control" id="tamren"
                                   value="{{ $mokrrer->tamren }}" required>
                        </div>
                        <div class="col">
                            <label for="amaly">عملى</label>
                            <input type="number" name="amaly" placeholder="عملى" class="form-control" id="amaly"
                                   value="{{ $mokrrer->amaly }}" required>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <label for="team" class="col-form-label">الفرقة والمستوى</label>
                    <input type="text" name="team" placeholder="الفرقة والمستوى" class="form-control" id="team"
                           value="{{ $mokrrer->team }}" required>
                </div>
                <div class="mb-2">
                    <label for="section" class="col-form-label">الفصل الدراسى</label>
                    <input type="text" name="section" placeholder="الفصل الدراسي" class="form-control" id="section"
                           value="{{ $mokrrer->section }}" required>
                </div>
                <div class="mb-2 text-center">
                    <div class="spinner-border text-primary m-1 d-none" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
                <div class="modal-footer" style="float: right">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>
            </form>
        </div>
    </div>

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
@endpush
