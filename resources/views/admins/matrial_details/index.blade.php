@extends('admins.layouts.app')

@push('title','توصيف المقرر ')

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
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18"> المقرر : {{ $matarial->name }}  </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @include('admins.includes.matarial_description_sidebar')
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <a href="{{ route('dashboard.matarials.create_matarial_description'  , $matarial->id) }}"
                           class="btn btn-primary waves-effect waves-light">
                            <i class="bx bx-add-to-queue font-size-16 align-middle me-2"></i>أضافه توصيف جديد
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered  table-striped">
                            <thead>
                            <tr>
                                <th> # </th>
                                <th>أسم الموضوع</th>
                                <th> نوع اللقاء</th>
                                <th>محتوى المقرر</th>
                                <th>طرق التعليم والتعلم </th>
                                <th>زمن التنفيذ الفعلى للانشطه التعليميه</th>
                                <th>أسباب التقويم</th>
                                <th>الأدلة والشواهد</th>
                                <th>التحكم</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($matrial_details as $item)
                                @foreach($item->descriptions as $detail)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $detail->name }}</td>
                                        <td>{{ $detail->type == 0 ? 'محاضره' : 'معمل' }}</td>
                                        <td>{{ $detail->matarial_content }}</td>
                                        <td>{{ $detail->educaion_method }}</td>
                                        <td>{{ $detail->time }}</td>
                                        <td>{{ $detail->takwem_methods }}</td>
                                        <td>{{ $detail->innvoice }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('dashboard.matarials_description.edit', $detail->id) }}" data-category-id="{{ $detail->id }}" class="text-muted font-size-20">
                                                    <i class="bx bxs-edit"></i>
                                                </a>
                                                <form action="{{ route('dashboard.matarials_description.destroy', $detail->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <a class="text-muted font-size-20 confirm-delete"><i class="bx bx-trash"></i></a>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">لا يوجد بيانات بالجدول</td>
                                </tr>
                            @endforelse


                            </tbody>
                        </table>
                    </div>
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

    @include('admins.matrial_details.scripts.delete')
@endpush
