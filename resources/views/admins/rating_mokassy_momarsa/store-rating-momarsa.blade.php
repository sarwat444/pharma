@extends('admins.rating_mokassy_members.layouts.app')

@push('title','ملفات الممارسه')

@push('styles')
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/select2/css/select2.min.css')}}" rel="stylesheet"
          type="text/css"/>

    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <!-- DataTables -->
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <!-- Responsive datatable examples -->
    <link
        href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
        rel="stylesheet" type="text/css"/>
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/select2/css/select2.min.css')}}" rel="stylesheet"
          type="text/css"/>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18"> {{$momarsa->name}}  </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">   {{$momarsa->name}} </a></li>
                        <li class="breadcrumb-item active"> الممارسه</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title"> تقيم الممارسة</div>
                    <form method="post" action="{{route('ratingmokassy.store_momarse_rating')}}">
                        @csrf
                        <input type="hidden" name="momarsa_id" value="{{$momarsa->id}}">
                        <div class="form-group mb-3">
                            <label for="rating">تقييم الممارسه</label>
                            <select id="rating" class="form-control" name="rate">
                                <option @if(!empty($rating)) @if($rating->rate == 0 ) selected @endif  @endif value="0">0</option>
                                <option @if(!empty($rating)) @if($rating->rate == 20 ) selected @endif @endif  value="20">1</option>
                                <option @if(!empty($rating)) @if($rating->rate == 40 ) selected @endif @endif  value="40">2</option>
                                <option @if(!empty($rating)) @if($rating->rate == 60 ) selected @endif @endif  value="60">3</option>
                                <option @if(!empty($rating)) @if($rating->rate == 80 ) selected @endif @endif  value="80">4</option>
                                <option @if(!empty($rating)) @if($rating->rate == 100) selected @endif @endif  value="100">5</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <textarea rows="10" class="form-control" placeholder="ملاحظات" name="notes">{{$rating->notes ?? '' }}</textarea>
                        </div>
                        <button  type="submit" class="btn-block btn btn-primary">تقييم الممارسه</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title"> التقييم</div>
                    <table class="table table-responsive table-bordered table-striped">
                        <thead>
                        <th>مستوى التقيم</th>
                        <th>النسبة</th>
                        <th>مبررات التقييم</th>
                        </thead>
                        <tbody>
                        <tr>
                            <td>0</td>
                            <td>0</td>
                            <td>الممارسة لم تتم باي صورة علي الاطلاق</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>20</td>
                            <td>الممارسة لها قرار معتمد ولم يتم الاعلان والمناقشة في المجالس الرسمية ولم يتم التنفيذ.
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>40</td>
                            <td> الممارسة لها قرار معتمد ومعلن وتمت مناقشتها في المجالس ولم يتم التنفيذ</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>60</td>
                            <td> الممارسة لها قرار معتمد ومعلن وتم مناقشتها وتنفيذها ولكن بصورة غير دورية ولم يتم
                                تقييمها ومردودها
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>80</td>
                            <td>الممارسة لها قرار معتمد ومعلن وتم مناقشتها و تنفيذها بصورة دورية ولم يتم تقييمها واتخاذ
                                إجراءات للتحسين
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>100</td>
                            <td>الممارسة لها قرار معتمد ومعلن وتم مناقشتها و تنفيذها بصورة دورية وتم تقييم المردود وتم
                                اتخاذ إجراءات فعالة للتحسين
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
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
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/select2/js/select2.min.js')}}"></script>

    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/form-advanced.init.js')}}"></script>

@endpush
