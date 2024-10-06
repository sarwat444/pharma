@extends('admins.layouts.app')
@push('title','الأسئله')
@push('styles')
    <link href="{{asset('/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"  type="text/css"/>
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"  type="text/css"/>
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/assets/admin/css/collegs.css')}}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
        @include('admins.includes.matarial_description_sidebar' , ['active' => 'mekyas_talem'])
    </div>
</div>
    <div class="row">
        <div class="col-3">
            @include('admins.includes.output_education_items')
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <button type="button" class="btn btn-primary waves-effect waves-light"
                                data-bs-toggle="modal" data-bs-target="#create-new-college">
                            <i class="bx bx-add-to-queue font-size-16 align-middle me-2"></i>أضافه سؤال
                        </button>
                        <a href="{{route('dashboard.student_results' , $teaching_output->id )}}" class="btn btn-primary">رصد درجات الطلاب </a>
                        <a href="{{route('dashboard.generate_questions_pdf' , $teaching_output->id )}}" class="btn btn-primary"><i class="fa fa-file-pdf"></i> تصدير ملف pdf </a>
                        <a href="{{route('dashboard.generate_all_questions_pdf' , $teaching_output->matarial_id)}}" class="btn btn-primary"><i class="fa fa-file-pdf"></i> تصدير ملف pdf لكل النواتج  </a>
                    </div>
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>السؤال</th>
                            <th> الدرجه العظمى </th>
                            <th>  نسبه التحقق  </th>
                            <th>التحكم </th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($questions as $question)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a  class="college_name" href="{{route('dashboard.programs.show', $question->id )}}">{{ $question->name }}</a></td>
                                <td><span class="badge badge-pill badge-soft-primary font-size-12">{{ $question->h_degree }}</span>
                                </td>
                                @php
                                        $percentage = $questionPercentages[$question->id] ?? 0;
                                        $badgeClass = '';
                                        if ($percentage > 50) {
                                            $badgeClass = 'badge-soft-success'; // Green for > 50%
                                        } elseif ($percentage >= 40) {
                                            $badgeClass = 'badge-soft-warning'; // Yellow for 40% - 50%
                                        } else {
                                            $badgeClass = 'badge-soft-danger'; // Red for < 40%
                                        }
                                @endphp
                                <td> <span class="badge {{ $badgeClass }}">{{ number_format($percentage, 2) }}%</span></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="javascript:void(0);" data-category-id="{{ $question->id }}"
                                           class="text-muted font-size-20 edit"><i class="bx bxs-edit"></i></a>
                                        <form action="{{ route('dashboard.questions.destroy', $question->id) }}"
                                              method="POST">@csrf @method('delete')
                                            <a class="text-muted font-size-20 confirm-delete"><i
                                                    class="bx bx-trash"></i></a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">لا  يوجد أسئله حاليه</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('admins.questions.modals.store-modal')
    @include('admins.questions.modals.edit-modal')
@endsection


@push('scripts')
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/sweet-alerts.init.js')}}"></script>
    <!-- Required datatable js -->
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Responsive examples -->
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <!-- Datatable init js -->
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/datatables.init.js')}}"></script>
    @include('admins.questions.scripts.store')
    @include('admins.questions.scripts.delete')
    @include('admins.questions.scripts.edit')
@endpush
