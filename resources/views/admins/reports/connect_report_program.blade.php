@extends('admins.layouts.app')
@push('title', 'تقرير نواتج البرنامج')
@push('styles')
@endpush

@section('content')
    <div class="container mt-4">
        <h3 class="text-center">تقرير النسبة المئوية لنواتج التعلم للبرنامج</h3>
        <div id="programOutputChart" style="height: 500px;"></div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Extracting data from the backend
        const chartData = @json($programOutputData);

        // Group data by category
        const categories = ['mind', 'knowledge', 'work skills', 'public skills'];
        const seriesData = categories.map(category => {
            return {
                name: category,
                data: chartData.filter(item => item.category === category).map(item => ({
                    x: item.name,
                    y: item.percentage
                }))
            };
        });

        // Initialize ApexCharts options
        var options = {
            chart: {
                type: 'bar',
                height: 500,
                toolbar: {
                    show: true
                }
            },
            series: seriesData,
            xaxis: {
                type: 'category',
                title: {
                    text: 'نواتج البرنامج',
                    style: {
                        fontSize: '14px',
                        fontWeight: 'bold',
                    }
                }
            },
            yaxis: {
                title: {
                    text: 'النسبة المئوية (%)',
                    style: {
                        fontSize: '14px',
                        fontWeight: 'bold',
                    }
                },
                labels: {
                    formatter: function (value) {
                        return value + '%';
                    }
                },
                max: 100 // Maximum value is 100 because we are dealing with percentages
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + "%";
                    }
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '50%',
                    endingShape: 'rounded'
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val + '%';
                },
                offsetY: -20,
                style: {
                    colors: ['#304758']
                }
            },
            title: {
                text: 'النسبة المئوية لنواتج البرنامج حسب الفئات',
                align: 'center',
                style: {
                    fontSize: '16px',
                    fontWeight: 'bold',
                    color: '#263238'
                }
            }
        };

        // Render the chart
        var chart = new ApexCharts(document.querySelector("#programOutputChart"), options);
        chart.render();
    </script>
@endpush
