@extends('admins.layouts.app')

@push('title','تقرير المعايير')

@push('styles')
    <link href="{{ asset('/assets/admin/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .btn_success {
            height: 10px;
            width: 10px;
            background-color: green;
            padding: 5px;
            color: #000;
            border-radius: 4px;
        }
        .btn_partial {
            height: 10px;
            width: 10px;
            background-color: yellow;
            padding: 5px;
            color: #000;
            border-radius: 4px;
        }
        .btn_danger {
            height: 10px;
            width: 10px;
            background-color: #ff0000;
            padding: 5px;
            color: #000;
            border-radius: 4px;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    @include('admins.programs.details.includes.program_sidebar')
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <div class="card-title mb-4">تقرير رفع الملفات للمعايير </div>
                    <div id="radial-charts" class="row"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset(PUBLIC_PATH.'/assets/admin/js/pages/sweet-alerts.init.js') }}"></script>
    <script src="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset(PUBLIC_PATH.'/assets/admin/js/pages/datatables.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mayers = @json($program->mayears);
            const mayerPercentages = @json($mayerPercentages);

            const radialChartsContainer = document.getElementById('radial-charts');

            mayers.forEach((mayer) => {
                const chartContainer = document.createElement('div');
                chartContainer.classList.add('col-md-4', 'mb-4');
                chartContainer.id = `chart-${mayer.id}`;
                radialChartsContainer.appendChild(chartContainer);

                let color;
                const percentage = mayerPercentages[mayer.id];
                if (percentage > 75) {
                    color = '#28a745'; // Success color
                } else if (percentage >= 50 && percentage <= 75) {
                    color = '#ffc107'; // Warning color
                } else {
                    color = '#dc3545'; // Danger color
                }

                const options = {
                    series: [percentage],
                    chart: {
                        type: 'radialBar',
                        height: 250
                    },
                    plotOptions: {
                        radialBar: {
                            startAngle: -90,
                            endAngle: 90,
                            dataLabels: {
                                name: {
                                    fontSize: '16px',
                                    color: undefined,
                                    offsetY: 70
                                },
                                value: {
                                    fontSize: '30px',
                                    color: '#111',
                                    offsetY: -10
                                }
                            }
                        }
                    },
                    colors: [color],
                    labels: [mayer.name]
                };

                const chart = new ApexCharts(chartContainer, options);
                chart.render();
            });
        });
    </script>
@endpush
