@extends('admins.layouts.app')

@push('title', 'إحصائيات الأستبيانات')
@push('styles')

@endpush
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-4">تقرير خاص  بنتائج الأستبيان</div>
                <h3 class="fs-4 mb-4" style="font-size: 14px !important; color: #005a85;">إجمالي عدد الطلاب: {{ $totalStudents }}</h3>
                <div id="chart"></div>
            </div>

            <div>

            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Extract the statistics from PHP to JavaScript
        const statistics = @json($statistics);

        // Prepare the data for the chart
        const categories = ["ضعيف جدا", "ضعيف", "مقبول", "جيد", "ممتاز"]; // الإجابات

        // نسبة كل إجابة
        const percentages = categories.map(key => statistics[key]?.percentage || 0);

        // تحديد الألوان بناءً على النسبة
        const colors = percentages.map(percentage => {
            if (percentage < 50) {
                return '#f00'; // أحمر
            } else if (percentage >= 50 && percentage <= 75) {
                return '#FFC300'; // أصفر
            } else {
                return '#28A745'; // أخضر
            }
        });

        // ApexCharts options
        const options = {
            chart: {
                type: 'bar',
                height: 350,
            },
            series: [{
                name: 'نسبة الإجابات', // نسبة الإجابات
                data: percentages, // نسبة كل إجابة
            }],
            colors: colors, // ألوان الأعمدة
            xaxis: {
                categories: categories,
                title: {
                    text: 'الإجابات (1-5)', // عنوان المحور السيني
                }
            },
            yaxis: {
                title: {
                    text: 'النسبة المئوية (%)', // عنوان المحور الصادي
                },
                max: 100, // الحد الأقصى للمحور الصادي
            },
            title: {
                text: '', // عنوان الرسم البياني
                align: 'center'
            },
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                    formatter: function(value) {
                        return `${value}%`; // عرض النسبة في التولتيب
                    }
                }
            }
        };

        // Create the chart
        const chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
@endpush

