@extends('admins.layouts.app')
@push('title','تعديل بيانات المؤشر')

@push('styles')
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/select2/css/select2.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <style>
        input[switch] {
            display: inline !important;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-6">
                        <form method="post"
                              action="{{route('dashboard.matarials_description.update' ,$matarial_description->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title mb-3">تعديل توصيف المقرر</div>
                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                    <label class="pt-2">أسم الموضوع </label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" name="name" class="form-control"
                                                           placeholder="أسم الموضوع"
                                                           value="{{$matarial_description->name}}">
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                    <label class="pt-2">نوع اللقاء </label>
                                                </div>
                                                <div class="col-md-9">
                                                    <select class="form-control" name="type">
                                                        <option value="0"
                                                                @if($matarial_description->type == 0) selected @endif>
                                                            محاضره
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                    <label class="pt-2">محتوى المقرر </label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" name="matarial_content" class="form-control"
                                                           placeholder="محتوى المقرر"
                                                           value="{{$matarial_description->matarial_content}}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                    <label class="pt-2"> طرق التعليم والتعلم </label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" name="educaion_method" class="form-control"
                                                           placeholder="طرق التعليم والتعلم "
                                                           value="{{$matarial_description->educaion_method}}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                    <label class="pt-2"> زمن التنفيذ الفعلى للانشطه التعليميه طبقا لجدول
                                                        المحاضرات </label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" name="time" class="form-control"
                                                           placeholder="ضع زمن التنفيذ الفعلى  "
                                                           value="{{$matarial_description->time}}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                    <label class="pt-2"> أسباب التقويم </label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" name="takwem_methods" class="form-control"
                                                           placeholder="أسباب التقويم "
                                                           value="{{$matarial_description->takwem_methods}}">
                                                </div>
                                            </div>
                                            <div class="row mb-5">
                                                <div class="col-md-3">
                                                    <label class="pt-2"> الأدلة والشواهد </label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" name="innvoice" class="form-control"
                                                           placeholder="الأدلة والشواهد "
                                                           value="{{$matarial_description->innvoice}}">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/select2/js/select2.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/js/pages/form-repeater.int.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/app.js')}}"></script>

@endpush
