@extends('admins.layouts.app')

@push('title', 'البرامج')
@push('styles')
    <link href="{{ asset(PUBLIC_PATH . '/assets/admin/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- DataTables -->
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/assets/admin/css/collegs.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-md-12">
            <h4> المقرر :: {{$mokrrer->name}}</h4>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4"> تقرير نسب  تحقق ناتج التعلم  </h4>
                <div id="chart" class="apex-charts" dir="ltr"></div>
            </div>
        </div><!--end card-->
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">

                <div class="card-body">
                    <div class="card-title">اختصارات النواتج</div>
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                        <th> الرقم</th>
                        <th>الناتج</th>
                        </thead>
                        <tbody>
                        @forelse($teaching_outputs as $output)
                            <tr>
                                <td>{{$output->id}}</td>
                                <td>{{$output->name}}</td>
                            </tr>
                        @empty
                            لا يوجد نواتج تعلم
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/sweet-alerts.init.js')}}"></script>
    <!-- Required datatable js -->
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Responsive examples -->
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <!-- Datatable init js -->
    <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/datatables.init.js')}}"></script>
    <script>
        $(document).ready(function () {
            var percentages = @json($teachingOutputPercentages);
            var teachingOutputs = @json($teaching_outputs->pluck('id', 'id'));

            // Define the colors array based on percentage ranges
            var colors = Object.values(percentages).map(function (percent) {
                if (percent > 50) return '#34c38f'; // Green
                else if (percent >= 40) return '#ffc107'; // Yellow
                else return '#dc3545'; // Red
            });

            var options = {
                series: [{
                    name: 'نسبة الطلاب',
                    data: Object.values(percentages).map(Math.round) // Round percentages to integers
                }],
                chart: {
                    height: 350,
                    type: 'bar',
                    events: {
                        click: function (chart, w, e) {
                            // Optionally handle click events
                        }
                    }
                },
                colors: colors,
                plotOptions: {
                    bar: {
                        columnWidth: '45%',
                        distributed: true
                    }
                },
                dataLabels: {
                    enabled: true, // Enable data labels
                    formatter: function (val) {
                        return Math.round(val) + '%'; // Format as integer percentage
                    }
                },
                legend: {
                    show: false
                },
                xaxis: {
                    categories: Object.values(teachingOutputs),
                    labels: {
                        style: {
                            colors: colors,
                            fontSize: '12px'
                        }
                    }
                },
                grid: {
                    borderColor: '#f1f1f1'
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        });
    </script>
@endpush
