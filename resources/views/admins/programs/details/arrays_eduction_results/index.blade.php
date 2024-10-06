@extends('admins.layouts.app')
@push('title','الأهداف العامة للبرنامج')

@push('styles')
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"
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
    <form action="{{ route('dashboard.program.output.store', $matrial->id) }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="card-title">ربط نواتج تعلم البرنامج الأكاديمي بنواتج تعلم المقرر</div>
                <div class="table-responsive">
                    <table class="table table-bordered  text-center">
                        <thead>
                        <tr>
                            <th rowspan="2"> </th>
                            <th rowspan="2"> </th>
                            <th class="text-center" colspan="{{
                                $matrila_output_educations->first()->program->mind->count() +
                                $matrila_output_educations->first()->program->knowledge->count() +
                                $matrila_output_educations->first()->program->workskills->count() +
                                $matrila_output_educations->first()->program->public_skills->count()
                            }}">نواتج تعلم البرنامج</th>
                        </tr>
                        <tr>
                            @if($matrila_output_educations->first()->program->mind->count() > 0)
                                <th colspan="{{ $matrila_output_educations->first()->program->mind->count() }}">المعرفة والفهم</th>
                            @endif
                            @if($matrila_output_educations->first()->program->knowledge->count() > 0)
                                <th colspan="{{ $matrila_output_educations->first()->program->knowledge->count() }}">المهارات الذهنية</th>
                            @endif
                            @if($matrila_output_educations->first()->program->workskills->count() > 0)
                                <th colspan="{{ $matrila_output_educations->first()->program->workskills->count() }}">المهارات المهنية</th>
                            @endif
                            @if($matrila_output_educations->first()->program->public_skills->count() > 0)
                                <th colspan="{{ $matrila_output_educations->first()->program->public_skills->count() }}">المهارات العامة</th>
                            @endif
                        </tr>
                        <tr>
                            <th>مقررات البرنامج</th>
                            <th>ناتج تعلم المقرر</th>
                            @foreach(['mind', 'knowledge', 'workskills', 'public_skills'] as $category)
                                @foreach($matrila_output_educations->first()->program->{$category} as $output)
                                    <th>{{ $output->name }}</th>
                                @endforeach
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($matrila_output_educations as $matrila_output_education)
                            @php $firstRow = true; @endphp
                            @foreach($matrila_output_education->education_output as $output)
                                <tr>
                                    @if($firstRow)
                                        <td rowspan="{{ $matrila_output_education->education_output->count() }}">
                                            {{ $matrila_output_education->name }}
                                        </td>
                                        @php $firstRow = false; @endphp
                                    @endif
                                    <td>{{ $output->name }}</td>

                                    @foreach(['mind', 'knowledge', 'workskills', 'public_skills'] as $category)
                                        @foreach($matrila_output_education->program->{$category} as $program_output)
                                            @php
                                                // Check if there's a match for this output and category
                                                $isChecked = $existingMatches->has($matrila_output_education->id) &&
                                                             $existingMatches[$matrila_output_education->id]
                                                             ->where('education_output_id', $output->id)
                                                             ->where('program_output_id', $program_output->id)
                                                             ->where('category', $category)
                                                             ->isNotEmpty();
                                            @endphp
                                            <td class="text-center">
                                                <input type="checkbox"
                                                       name="match[{{ $matrila_output_education->id }}][{{ $output->id }}][{{ $category }}][]"
                                                       value="{{ $program_output->id }}"
                                                    {{ $isChecked ? 'checked' : '' }}>
                                            </td>
                                        @endforeach
                                    @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">حفظ النتائج <i class="fa fa-save"></i></button>
                </div>
            </div>
        </div>
    </form>
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
