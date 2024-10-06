@extends('admins.layouts.app')

@push('title','توصيف المقرر ')

@push('styles')
@endpush
@section('content')
    <form method="post" action="{{route('dashboard.matarials_description.store')}}">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title mb-3">أضافة توصيف المقرر</div>
                        <input type="hidden" name="matarial_id" value="{{$matarial_id}}">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label class="pt-2">أسم الموضوع </label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control" placeholder="أسم الموضوع">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label class="pt-2">نوع اللقاء </label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" name="type">
                                    <option value="0">محاضره</option>
                                    <option value="1">معمل</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label class="pt-2">محتوى المقرر </label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="matarial_content" class="form-control"
                                       placeholder="محتوى المقرر">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label class="pt-2"> طرق التعليم والتعلم </label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="educaion_method" class="form-control"
                                       placeholder="طرق التعليم والتعلم ">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label class="pt-2"> زمن التنفيذ الفعلى للانشطه التعليميه طبقا لجدول المحاضرات </label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="time" class="form-control"
                                       placeholder="ضع زمن التنفيذ الفعلى  ">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label class="pt-2"> أسباب التقويم </label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="takwem_methods" class="form-control"
                                       placeholder="أسباب التقويم ">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-3">
                                <label class="pt-2"> الأدلة والشواهد </label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="innvoice" class="form-control" placeholder="الأدلة والشواهد ">
                            </div>
                        </div>
                        <button type="submit" class="btn btn btn-primary" style="width: 150px"><i
                                class="fa fa-save"></i> حفظ
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/jquery.repeater/jquery.repeater.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/form-repeater.int.js')}}"></script>
@endpush

