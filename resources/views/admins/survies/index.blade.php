@extends('admins.layouts.app')

@push('title','الأستبيانات')

@push('styles')
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link
        href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
        rel="stylesheet" type="text/css"/>
    <style>
        .share_btn
        {
            font-size: 12px;
            padding: 6px;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('admins.includes.matarial_description_sidebar')
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-size-15" id="staticBackdropLabel">لينك مشاركه الأستبيان للطلبة</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label>لينك المشاركه</label>
                            <div class="input-group">
                                <input id="shareLink" type="text" class="form-control" readonly>
                                <button class="btn btn-outline-secondary" type="button" id="copyButton">Copy</button>
                            </div>
                            <div id="copyAlert" class="alert alert-success mt-2" style="display: none;">
                                تم نسخ الرابط بنجاح
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">أغلاق</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <button type="button" class="btn btn-primary waves-effect waves-light"
                                data-bs-toggle="modal" data-bs-target="#create-new-category">
                            <i class="bx bx-add-to-queue font-size-16 align-middle me-2"></i>أضافه أستبيان
                        </button>
                    </div>
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الأستبيان</th>
                            <th>حاله الاستبيان</th>
                            <th>عدد الأسئلة</th>
                            <th>تم أنشاءه</th>
                            <th>نشر الأستبيان </th>
                            <th>تقرير الأستبيان</th>
                            <th>التحكم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($survies as $survey)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="{{route('dashboard.survey_category_questions.show' , $survey->id )}}">{{ $survey->name }}</a>
                                </td>
                                <td>@if($survey->status == 1 )
                                        <span class="badge badge-soft-success">نشط</span>
                                    @else
                                        <span class="badge badge-soft-danger">غير نشط </span>
                                    @endif</td>
                                <td><span
                                        class="badge badge-pill badge-soft-primary font-size-12">{{ $survey->questions_count ?? '0' }}</span>
                                </td>
                                <td>{{$survey->created_at}}</td>
                                <td>
                                    <button data-id="{{$survey->id}}" id="share_btn{{$survey->id}}" type="button" class="btn btn-primary share_btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        <i class="fa fa-share"></i>
                                    </button>
                                </td>
                                <td><a class="btn btn-primary" href="{{route('dashboard.survey.view_statitastics' ,$survey->id )}}"> عرض  تقرير الأستبيان  <i class="fa fa-eye"></i> </a> </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="javascript:void(0);" data-category-id="{{ $survey->id }}"
                                           class="text-muted font-size-20 edit"><i class="bx bxs-edit"></i></a>
                                        <form action="{{ route('dashboard.survey.destroy', $survey->id) }}"
                                              method="POST">@csrf @method('delete')
                                            <a class="text-muted font-size-20 confirm-delete"><i
                                                    class="bx bx-trash"></i></a>
                                        </form>
                                        <a href="{{ route('dashboard.survey.view_details', $survey->id) }}"><i style="font-size: 15px;
                                            margin-top: 6px;
                                            margin-right: 4px;
                                            color: #74788d;"
                                             class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">لا يوجد أستبيانات حاليه</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('admins.survies.modals.store-modal')
    @include('admins.survies.modals.edit-modal')
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
    @include('admins.survies.scripts.store')
    @include('admins.survies.scripts.delete')
    @include('admins.survies.scripts.edit')
    <script>
        $(document).ready(function() {
            // Handle share link population
            $('.share_btn').on('click', function() {
                var data_id = $(this).data('id');
                var shareLink = "{{ url('/home/ViewSurvey/:id') }}";
                shareLink = shareLink.replace(':id', data_id);
                $('#shareLink').val(shareLink);
            });

            // Handle copy button click
            $('#copyButton').on('click', function() {
                var copyText = document.getElementById("shareLink");
                copyText.select();
                copyText.setSelectionRange(0, 99999); // For mobile devices

                // Copy the text to the clipboard
                document.execCommand("copy");

                // Show the copied alert
                $('#copyAlert').fadeIn().delay(1000).fadeOut();
            });
        });
    </script>
@endpush
