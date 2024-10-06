@extends('admins.layouts.app')
@push('title','تقرير مدخلات المقرر')
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
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    @include('admins.programs.details.includes.program_sidebar' , ['active' => 'report_input' ])
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">

                    <div class="card-title mb-4">تقرير مدخلات المقرر</div>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered  table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>أسم المقرر</th>
                                <th>نتائج التعلم</th>
                                <th>خريطه المنهج - الأدلة والشواهد</th>
                                <th> التقرير الأسبوعى - الأدلة والشواهد</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($matarils as $matarial)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><p>{{ $matarial->name }}</p></td>
                                    <td>
                                        @php
                                            $result = 0;
                                            $countedTypes = [];
                                        @endphp
                                        @forelse($matarial->education_output as $output)
                                            @if (!in_array($output->type, $countedTypes))
                                                @php
                                                    $countedTypes[] = $output->type;
                                                    $result += 25;
                                                @endphp
                                            @endif
                                        @empty
                                        @endforelse
                                        @php
                                            $badgeClass = 'badge-soft-danger'; // Default class
                                            if ($result >= 100) {
                                                $badgeClass = 'badge-soft-success'; // Green
                                            } elseif ($result >= 75) {
                                                $badgeClass = 'badge-soft-primary'; // Blue
                                            } elseif ($result >= 50) {
                                                $badgeClass = 'badge-soft-warning'; // Yellow
                                            }
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $result }} %</span>
                                    </td>

                                    <td>
                                        @php
                                            $result = 0;
                                            $weekNumbers = [];
                                        @endphp
                                        @forelse($matarial->innvoices as $invoice)
                                            @if (!in_array($invoice->week_number, $weekNumbers))
                                                @php
                                                    $weekNumbers[] = $invoice->week_number;
                                                    $result += 7.2; // Adjust this value as needed
                                                @endphp
                                            @endif
                                        @empty
                                        @endforelse
                                        @php
                                            $badgeClass = 'badge-soft-danger'; // Default class
                                            if ($result >= 50) {
                                                $badgeClass = 'badge-soft-success'; // Green
                                            } elseif ($result >= 40 && $result < 50) {
                                                $badgeClass = 'badge-soft-warning'; // Yellow
                                            } elseif ($result < 40) {
                                                $badgeClass = 'badge-soft-danger'; // Red
                                            }
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ intval($result) }} %</span>
                                    </td>

                                    <td>
                                        @php
                                            $result = 0;
                                            $weekNumbers = [];
                                        @endphp
                                        @forelse($matarial->innvoice_weeks as $invoice)
                                            @if (!in_array($invoice->week_number, $weekNumbers))
                                                @php
                                                    $weekNumbers[] = $invoice->week_number;
                                                    $result += 7.2; // Adjust this value as needed
                                                @endphp
                                            @endif
                                        @empty
                                        @endforelse
                                        @php
                                            $badgeClass = 'badge-soft-danger'; // Default class
                                            if ($result >= 50) {
                                                $badgeClass = 'badge-soft-success'; // Green
                                            } elseif ($result >= 40 && $result < 50) {
                                                $badgeClass = 'badge-soft-warning'; // Yellow
                                            } elseif ($result < 40) {
                                                $badgeClass = 'badge-soft-danger'; // Red
                                            }
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ intval($result) }} %</span>
                                    </td>


                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">لا يوجد بيانات بالجدول</td>
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
@endpush
