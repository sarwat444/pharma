@extends('admins.layouts.app')

@push('title','أسئلة الأستبيان')

@push('styles')
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"  type="text/css"/>
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <button type="button" class="btn btn-primary waves-effect waves-light"
                                data-bs-toggle="modal" data-bs-target="#create-new-category">
                            <i class="bx bx-add-to-queue font-size-16 align-middle me-2"></i>أضافه سؤال
                        </button>
                    </div>
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>السؤال</th>
                            <th>التحكم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($questions as $question)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{route('dashboard.survey_questions.show' , $question->id )}}">{{ $question->name }}</a> </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="javascript:void(0);" data-category-id="{{ $question->id }}"
                                           class="text-muted font-size-20 edit"><i class="bx bxs-edit"></i></a>
                                        <form action="{{ route('dashboard.survey_questions.destroy', $question->id) }}"
                                              method="POST">@csrf @method('delete')
                                            <a class="text-muted font-size-20 confirm-delete"><i
                                                    class="bx bx-trash"></i></a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">لا يوجد أسئله حاليه</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('admins.survey_questions.modals.store-modal')
    @include('admins.survey_questions.modals.edit-modal')
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

    @include('admins.survey_questions.scripts.store')
    @include('admins.survey_questions.scripts.delete')
    @include('admins.survey_questions.scripts.edit')
@endpush
