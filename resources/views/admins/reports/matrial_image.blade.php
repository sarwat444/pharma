@extends('admins.layouts.app')
@push('title',__('admins.all admins'))
@push('styles')
    <link href="{{asset('/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"  type="text/css"/>
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"  type="text/css"/>
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        canvas {
            width: 100% !important;
            height: auto !important;
        }
        .report .main-title
        {
            color: #005a85;
            background-color: #eee;
            padding: 18px;
            font-size: 15px !important;
        }
        .report .subtitle
        {
            color: #9d7e63;
            font-weight: bold;
            margin-bottom: 23px;
            margin-top: 24px;
        }

    </style>
@endpush
@section('content')
    <div class="card report">
        <div class="card-body">
            <div class="card-title"> تقرير المقرر بالكامل <a style="float: left" href="{{route('dashboard.mokrr.generate_pdf' , $matarial->id)}}" class="btn btn-primary"> طباعه التقرير <i class="bx bx-save"></i> </a> </div>
            <div class="main-information">
                <h3 class="main-title">توصيف المقرر</h3>
                <table  class="table table-bordered  table-striped">
                    <thead>
                        <tr>
                            <th> #</th>
                            <th>أسم الموضوع</th>
                            <th> نوع اللقاء</th>
                            <th>محتوى المقرر</th>
                            <th>طرق التعليم والتعلم</th>
                            <th>زمن التنفيذ الفعلى للانشطه التعليميه</th>
                            <th>أسباب التقويم</th>
                            <th>الأدلة والشواهد</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($matarial->descriptions as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $detail->name }}</td>
                            <td>{{ $detail->type == 0 ? 'محاضره' : 'معمل' }}</td>
                            <td>{{ $detail->matarial_content }}</td>
                            <td>{{ $detail->educaion_method }}</td>
                            <td>{{ $detail->time }}</td>
                            <td>{{ $detail->takwem_methods }}</td>
                            <td>{{ $detail->innvoice }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">لا يوجد بيانات بالجدول</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="education_output">
                    <h3 class="main-title"> نواتج التعلم </h3>
                    <h6 class="subtitle">المعلومات والمفاهيم </h6>
                    <table   class="table table-bordered  table-striped">
                        <thead>
                        <tr>
                            <th>ناتج التعلم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($output_1 as $output)
                            <tr>
                                <td><p>{{ $loop->iteration }}- {{ $output->name }} </p></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">لا يوجد بيانات بالجدول</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <h6 class="subtitle">أ-  المهارات الذهنية </h6>
                    <table  class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th> المهارات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($output_2 as $output)
                            <tr>
                                <td><p>{{ $loop->iteration }}- {{ $output->name }} </p></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">لا يوجد بيانات بالجدول</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <h6 class="subtitle"> ب - المهارات المهنية  </h6>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th> المهارات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($output_3 as $output)
                            <tr>
                                <td><p>{{ $loop->iteration }}- {{ $output->name }} </p></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">لا يوجد بيانات بالجدول</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <h6 class="subtitle"> ج - المهارات العامة  </h6>
                    <table  class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th> المهارات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($output_4 as $output)
                            <tr>
                                <td><p>{{ $loop->iteration }}- {{ $output->name }} </p></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">لا يوجد بيانات بالجدول</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="report_statastics">
                    <h3 class="main-title"> تقرير المقرر </h3>
                    <div class="row justify-content-center">
                        <div class="col-md-7">
                            <div style="width: 100%; margin: auto;">
                                <canvas id="myChart"></canvas>
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
            <script src="{{asset(PUBLIC_PATH.'assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
            <!-- Responsive examples -->
            <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
            <script src="{{asset(PUBLIC_PATH.'/assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
            <!-- Datatable init js -->
            <script src="{{asset(PUBLIC_PATH.'/assets/admin/js/pages/datatables.init.js')}}"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Prepare the data
                    var percentages = @json($teachingOutputPercentages);
                    var teachingOutputs = @json($teaching_outputs->pluck('id', 'id'));

                    // Convert data to arrays
                    var labels = Object.values(teachingOutputs);
                    var data = Object.values(percentages).map(Math.round); // Ensure integer values
                    var colors = data.map(function (percent) {
                        if (percent > 50) return '#34c38f'; // Green
                        else if (percent >= 40) return '#ffc107'; // Yellow
                        else return '#dc3545'; // Red
                    });

                    // Render the chart
                    const ctx = document.getElementById('myChart').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels, // Dynamic labels
                            datasets: [{
                                label: 'نسبة الطلاب', // Arabic text
                                data: data, // Dynamic data
                                backgroundColor: colors, // Dynamic colors
                                borderColor: colors.map(color => color.replace('0.2', '1')), // Border colors
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function (tooltipItem) {
                                            return Math.round(tooltipItem.raw) + '%'; // Format as integer percentage
                                        }
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    ticks: {
                                        color: colors // Colors for x-axis labels
                                    }
                                },
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                    // Automatically upload chart as an image after rendering
                    setTimeout(function () {
                        html2canvas(document.querySelector('#myChart')).then(function (canvas) {
                            const imgData = canvas.toDataURL('image/png');

                            // Create FormData object to send the image
                            const formData = new FormData();
                            formData.append('image', imgData);

                            // Send the image to the server using AJAX
                            fetch('{{route('dashboard.save.chart.image')}}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'  // Include CSRF token for security
                                },
                                body: formData
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        console.log('Image uploaded successfully!');
                                    } else {
                                        console.error('Error uploading image');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });
                        });
                    }, 1000); // Delay to ensure the chart is fully rendered before capturing
                });
            </script>
    @endpush
