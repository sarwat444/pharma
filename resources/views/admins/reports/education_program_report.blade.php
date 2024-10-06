@extends('admins.layouts.app')

@push('title', 'البرامج')
@push('styles')
    <!-- Include your styles here -->
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-md-12">
            <h4> البرنامج :: {{$program->program}}</h4>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4"> تقرير نسب  تحقق ناتج التعلم لكل مقرر  </h4>
                <div id="chart" class="apex-charts" dir="ltr"></div>
            </div>
        </div><!--end card-->
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">المواد الدراسية</div>
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                        <th> الرقم</th>
                        <th>المادة</th>
                        </thead>
                        <tbody>
                        @forelse($materials as $material)
                            <tr>
                                <td>{{$material->id}}</td>
                                <td>{{$material->name}}</td>
                            </tr>
                        @empty
                            لا توجد مواد دراسية
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
            var materialPercentages = @json($materialPercentages);
            var materials = @json($materials->pluck('id', 'id'));

            // Define the colors array based on percentage ranges
            var colors = Object.values(materialPercentages).map(function (percent) {
                if (percent > 50) return '#34c38f'; // Green
                else if (percent >= 40) return '#ffc107'; // Yellow
                else return '#dc3545'; // Red
            });

            var options = {
                series: [{
                    name: 'نسبة الطلاب',
                    data: Object.values(materialPercentages).map(Math.round) // Round percentages to integers
                }],
                chart: {
                    height: 350,
                    type: 'bar',
                },
                colors: colors,
                plotOptions: {
                    bar: {
                        columnWidth: '45%',
                        distributed: true
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return Math.round(val) + '%';
                    }
                },
                legend: {
                    show: false
                },
                xaxis: {
                    categories: Object.values(materials),
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
