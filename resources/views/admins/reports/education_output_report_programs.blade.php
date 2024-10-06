@extends('admins.layouts.app')

@push('title', 'البرامج')
@push('styles')
    <link href="{{ asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush

@section('content')
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">قياس نواتج التعلم بالبرامج</h4>
                    <div id="chart" class="apex-charts" dir="ltr"></div>
                </div>
            </div><!--end card-->
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        مختصرات أكواد البرامج
                    </div>
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 table-striped">
                        <thead>
                        <tr>
                            <th>الكود </th>
                            <th>البرنامج</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($programs  as $program)
                            <tr>
                                <td>{{ $program->id }}</td>
                                <td style="text-align: right">{{ $program->program }} </td>
                                </td>
                            </tr>
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
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        $(document).ready(function () {
            var programPercentages = @json($programPercentages);
            var programs = @json($programs->pluck('id', 'id'));
            var colors = [];
            var percentages = [];

            // Create data for the chart
            for (var id in programPercentages) {
                var percentage = Math.round(programPercentages[id]);  // Ensure integer values
                percentages.push(percentage);

                if (percentage > 50) {
                    colors.push('#00E396');  // Green
                } else if (percentage >= 40 && percentage <= 50) {
                    colors.push('#FEB019');  // Yellow
                } else {
                    colors.push('#FF4560');  // Red
                }
            }

            var options = {
                series: [{
                    name: 'نسبة الناتج ',
                    data: percentages
                }],
                chart: {
                    height: 350,
                    type: 'bar',
                    toolbar: {show: false}
                },
                colors: colors,
                plotOptions: {
                    bar: {
                        columnWidth: '45%',
                        distributed: true,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    categories: Object.values(programs),
                    labels: {
                        style: {
                            colors: colors,
                            fontSize: '12px'
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        });
    </script>
@endpush
