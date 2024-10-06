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
    <h3 class="main-title">توصيف المقرر</h3>
    <table id="datatable" class="table table-bordered  table-striped">
        <thead>
        <tr>
            <th> # </th>
            <th>أسم الموضوع</th>
            <th> نوع اللقاء</th>
            <th>محتوى المقرر</th>
            <th>طرق التعليم والتعلم </th>
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
</div>
<div class="education_output">
    <h3 class="main-title"> نواتج التعلم </h3>
    <h6 class="subtitle">المعلومات والمفاهيم </h6>
    <table id="datatable" class="table table-bordered table-striped">
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
    <h6 class="subtitle">المهارات الذهنية  </h6>
    <table id="datatable" class="table table-bordered table-striped">
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
    <h6 class="subtitle">المهارات المهنية  </h6>
    <table id="datatable" class="table table-bordered table-striped">
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
    <h6 class="subtitle">المهارات العامة  </h6>
    <table id="datatable" class="table table-bordered table-striped">
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
    <div class="report_image">
        <h3 class="main-title">  قياس مدى تحقق نواتج التعلم للمقرر  </h3>
        <img src="{{$chart_image}}" alt="$chart_image">
    </div>

</div>
</body>
</html>


