@extends('admins.layouts.app')
@push('title','رصد درجات الطلاب ')
@push('styles')
    <link href="{{asset('/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"  type="text/css"/>
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"  type="text/css"/>
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/assets/admin/css/collegs.css')}}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <h4>  ناتج التعلم :: {{$teaching_output->name}} </h4>
    <input type="hidden" name="teaching_output_id" value="{{$teaching_output->id}}" id="teaching_output_id">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">رصد نتائج الطلاب</h4>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-editable table-nowrap align-middle table-edits table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>الرقم</th>
                                    <th>الطالب</th>
                                    @foreach($questions as $question)
                                        <th>{{ $question->name }}</th>
                                        <th>درجة الطالب / العظمى</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $student->name }}</td>
                                        @foreach($questions as $question)
                                            @php
                                                $result = $students_results->where('student_id', $student->id)->where('question_id', $question->id)->first();

                                           @endphp
                                            <td>{{ $question->name }}</td>
                                            <td class="d-flex">
                                                <input type="text"
                                                       style="width: 70px; margin-left: 10px;"
                                                       class="form-control student-degree"
                                                       data-student="{{ $student->id }}"
                                                       data-question="{{ $question->id }}"
                                                       value="{{ $result ? $result->grade : '' }}">
                                                /
                                                <span
                                                    style="
                                                    font-size: 10px;
                                                    padding-top: 10px;
                                                    margin-right: 9px;
                                                    font-weight: bold;"
                                                    class="badge badge-soft-primary">{{ $question->h_degree }}</span>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                @if($students->isEmpty())
                                    <tr>
                                        <td colspan="{{ count($questions) * 2 + 2 }}">لا يوجد درجات للطلاب</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

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

    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/table-edits/build/table-edits.min.js')}}"></script>

    <script src="{{asset(PUBLIC_PATH.'assets/admin/js/pages/table-editable.int.js')}}"></script>

    <script>
        $(document).ready(function() {
            // Bind input change events
            $('#datatable').on('change', '.student-degree', function() {
                let teaching_output_id = $('#teaching_output_id').val() ;
                let studentId = $(this).data('student');
                let questionId = $(this).data('question');
                let degree = $(this).val();

                // Perform AJAX request to save the degree
                $.ajax({
                    url: '{{ route('dashboard.save-student-results22') }}', // Adjust to your route
                    type: 'POST',
                    data: {
                        student_id: studentId,
                        question_id: questionId,
                        degree: degree,
                        teaching_output_id : teaching_output_id ,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Handle success response
                        console.log('Result saved successfully.');
                    },
                    error: function(xhr) {
                        // Handle error response
                        console.error('Failed to save result.');
                    }
                });
            });
        });
        </script>
@endpush
