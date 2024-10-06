<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Include Bootstrap CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100..900&display=swap" rel="stylesheet">
    <!-- Include custom CSS with font -->
    <style>
        body {
            font-family: 'aealarabiya';
            direction: rtl;
            font-weight: 400;
            font-size: 11px !important;
        }

        /* Add custom styles for the table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: right;
        }

        th {
            background-color: #cccccc;
        }
        .logos {
            margin: 0 10px; /* Add margin between items */
            width: 200px;
        }

        .logos .image
        {
            width:100px ;
            float: left;
            display: inline-block;
        }

        .logos img {
            height: 50px;
            width: 50px;
            margin-bottom: -15px;
        }

        .logos h4 {
            font-size: 14px;
            padding: 0;
        }

        tbody  tr  td{
            font-weight: 500;
            font-size: 10px;
            padding: 10px;

        }
        .main-information ,
        .goals
        {
            margin-bottom: 0 !important;
        }
        .main-title
        {
            color: #005a85;
            background-color: #eee;
            padding: 15px ;
        }
        .subtitle
        {
            font-size: 10px;
            font-weight: bold;
        }

    </style>
</head>
<body>
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

        <table id="datatable" class="table table-bordered table-striped">
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
</div>
<div class="report_image">
    <h3 class="main-title">  تقرير مدى تحقق نواتج التعلم </h3>
    <img src="{{$programImage}}" alt="{{$programImage}}">
</div>
</body>
</html>
