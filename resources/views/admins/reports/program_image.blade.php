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
            <div class="card-title"> تقرير البرنامج  <a style="float: left" href="{{route('dashboard.program.generate_program_pdf' , $program->id )}}" class="btn btn-primary"> طباعه التقرير <i class="bx bx-save"></i> </a> </div>
            <div class="main-information">
                <h3 class="main-title">التعريف بالبرنامج والمعلومات العامه عنه</h3>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <td>أسم البرنامج</td>
                        <td style="padding: 20px !important;">{{$program->program ?? ''}}</td>
                    </tr>
                    <tr>
                        <td>طبيعة البرنامج</td>
                        <td style="padding: 10px">
                            @if($program->type == 0)
                                أحادى
                            @elseif($program->type == 1)
                                ثنائي
                            @elseif($program->type == 2)
                                مشترك
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>القسم المسؤل عن البرنامج</td>
                        <td style="padding: 20px !important;">{{$program->section ?? ''}}</td>
                    </tr>
                    <tr>
                        <td>تاريخ أقرار البرنامج</td>
                        <td style="padding: 20px !important;">{{ $program->added_date ? $program->added_date->format('Y-m-d') : '' }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="goals">
                <h3 class="main-title"> الأهداف العامة للبرنامج </h3>
                <div class="table-responsive">

                    <table  class="table table-bordered table-striped">
                        <thead>
                        <tr style="background-color: #cccccc">
                            <th>الهدف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($program->goals  as $goal)
                            <tr style="padding: 20px !important;">
                                <td style="padding: 20px !important;"><p style="padding: 20px !important;">{{ $loop->iteration }} - {{ $goal->goal }} </p></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">لا يوجد بيانات بالجدول</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="goals">
                    <h3 class="main-title">المخرجات التعليمة للبرنامج ::</h3>
                    <h6 class="subtitle"> أ- القدرات الذهنية </h6>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>القدرة</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($program->mind  as $mind)
                            <tr>
                                <td><p style="padding: 10px">{{ $loop->iteration }} - {{ $mind->name }} </p></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">لا يوجد بيانات بالجدول</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <h6 class="subtitle"> ب-  المعرفة والفهم </h6>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr >
                            <th>المعرفة والفهم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($program->knowledge  as $knowledge)
                            <tr>
                                <td><p style="padding: 10px">{{ $loop->iteration }} - {{ $knowledge->name }} </p></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">لا يوجد بيانات بالجدول</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <h6 class="subtitle"> ت- المهارات العلمية والعمليه </h6>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr >
                            <th> المهارات العلمية والعملية	</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($program->workskills  as $skill)
                            <tr>
                                <td><p style="padding: 10px">{{ $loop->iteration }} - {{ $skill->name }} </p></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">لا يوجد بيانات بالجدول</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <h6 class="subtitle"> ت- المعايير الأكاديمية للبرنامج   </h6>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th> المعايير الأكاديمية</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($program->standars  as $standar)
                            <tr>
                                <td><p style="padding: 10px">{{ $loop->iteration }} - {{ $standar->name }} </p></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">لا يوجد بيانات بالجدول</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- مقررات البرنامج -->
                <div class="matrials">
                    <h3 class="main-title"> مقررات البرنامج </h3>
                    <h6 class="subtitle"> أ- المقرر الألزامى</h6>
                    <table class="table table-bordered  table-striped">
                        <thead>
                        <tr>
                            <th rowspan="2">كود / رقم المقرر</th>
                            <th rowspan="2">أسم المقرر</th>
                            <th rowspan="2">عدد الوحدات</th>
                            <th colspan="3">عدد الساعات الاسبوعيه</th>
                            <th rowspan="2">الفرقه والمستوى</th>
                            <th rowspan="2">الفصل الدراسي</th>
                        </tr>
                        <tr>
                            <th>عملى</th>
                            <th>تمارين</th>
                            <th>نظرى</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($matriles_1 as $matarial)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><p>{{ $matarial->name }}</p></td>
                                <td>{{ $matarial->units }}</td>
                                <td>{{ $matarial->amaly }}</td>
                                <td>{{ $matarial->tamren }}</td>
                                <td>{{ $matarial->nazary }}</td>
                                <td>{{ $matarial->team }}</td>
                                <td>{{ $matarial->section }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">لا يوجد بيانات بالجدول</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <h6 class="subtitle">ب- المقرر الأنتقائي</h6>
                    <table class="table table-bordered  table-striped">
                        <thead>
                        <tr>
                            <th rowspan="2">كود / رقم المقرر</th>
                            <th rowspan="2">أسم المقرر</th>
                            <th rowspan="2">عدد الوحدات</th>
                            <th colspan="3">عدد الساعات الاسبوعيه</th>
                            <th rowspan="2">الفرقه والمستوى</th>
                            <th rowspan="2">الفصل الدراسي</th>
                        </tr>
                        <tr>
                            <th>عملى</th>
                            <th>تمارين</th>
                            <th>نظرى</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($matriles_2 as $matarial)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><p>{{ $matarial->name }}</p></td>
                                <td>{{ $matarial->units }}</td>
                                <td>{{ $matarial->amaly }}</td>
                                <td>{{ $matarial->tamren }}</td>
                                <td>{{ $matarial->nazary }}</td>
                                <td>{{ $matarial->team }}</td>
                                <td>{{ $matarial->section }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">لا يوجد بيانات بالجدول</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <h6 class="subtitle"> ت -المقرر الأختياري</h6>
                    <table class="table table-bordered  table-striped">
                        <thead>
                        <tr>
                            <th rowspan="2">كود / رقم المقرر</th>
                            <th rowspan="2">أسم المقرر</th>
                            <th rowspan="2">عدد الوحدات</th>
                            <th colspan="3">عدد الساعات الاسبوعيه</th>
                            <th rowspan="2">الفرقه والمستوى</th>
                            <th rowspan="2">الفصل الدراسي</th>
                        </tr>
                        <tr>
                            <th>عملى</th>
                            <th>تمارين</th>
                            <th>نظرى</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($matriles_3 as $matarial)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><p>{{ $matarial->name }}</p></td>
                                <td>{{ $matarial->units }}</td>
                                <td>{{ $matarial->amaly }}</td>
                                <td>{{ $matarial->tamren }}</td>
                                <td>{{ $matarial->nazary }}</td>
                                <td>{{ $matarial->team }}</td>
                                <td>{{ $matarial->section }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">لا يوجد بيانات بالجدول</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="report_statastics">
                    <h3 class="main-title"> تقرير نواتج تعلم البرنامج  </h3>
                    <div class="row justify-content-center">
                        <div class="col-md-7">
                            <div style="width: 100%; margin: auto;">
                                <canvas id="myChart"></canvas>
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
                            var percentages = @json($teachingOutputPercentages);  // Material-wise percentages
                            var labels = Object.keys(percentages);  // Material names
                            var data = Object.values(percentages).map(Math.round); // Ensure integer values

                            // Set colors based on the percentage
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
                                    labels: labels,  // Dynamic labels (Material names)
                                    datasets: [{
                                        label: 'نسبة الطلاب', // Arabic text for 'Percentage of Students'
                                        data: data, // Dynamic data (percentages)
                                        backgroundColor: colors, // Dynamic colors
                                        borderColor: colors, // Border colors same as background
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
                                                    return Math.round(tooltipItem.raw) + '%'; // Display percentage
                                                }
                                            }
                                        }
                                    },
                                    scales: {
                                        x: {
                                            ticks: {
                                                color: '#000',  // Optionally, set a default color for x-axis labels
                                            }
                                        },
                                        y: {
                                            beginAtZero: true,
                                            ticks: {
                                                callback: function(value) {
                                                    return value + '%'; // Y-axis as percentage
                                                }
                                            }
                                        }
                                    }
                                }
                            });

                            // Optionally, capture chart as image and send to server
                            setTimeout(function () {
                                html2canvas(document.querySelector('#myChart')).then(function (canvas) {
                                    const imgData = canvas.toDataURL('image/png');

                                    const formData = new FormData();
                                    formData.append('image', imgData);

                                    fetch('{{ route("dashboard.save.program_chart.image") }}', {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
                            }, 1000); // Wait for chart to render before capturing
                        });
                    </script>

    @endpush
