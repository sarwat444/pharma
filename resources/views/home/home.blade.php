@extends('home.layouts.homelayout')
@push('title','تسجيل دخول الجهات')
@push('styles')
    <style>
        body , html
        {
            direction: rtl;
            text-align: right;
            background-color: #eee;
        }
        body
        {
            direction: rtl;
            font-family: 'Noto Kufi Arabic', sans-serif;
            background-size: cover;
            background-position: center;
        }
        .logo
        {
            border-radius: 50%;
            border: 2px solid #eee;
            padding: 0;
            height: 114px;
            margin-bottom: 20px ;
        }
        .main-directions h3
        {
            color: #9d1819;
            font-size: 22px;
            margin-top: 48px;
            font-weight: bold;
        }
        .btn {
            padding: 6px 51px;
            font-size: 16px;
            color: #fff;
            background-color: #083252;
            border-color: #556ee6;
            border: 0;
            border: 1px solid #606060;
        }
        .main-directions   p{
            margin-top: 19px;
            color: #636363;
            font-size: 16px;
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 col-xl-12 text-center">
                <img class="mb-3" src="{{asset(PUBLIC_PATH.'assets/site/images/main-logo.png')}}">
                <div class="main-directions">
                    <h3> مرحبا بكم . فى  نظام أتقان  </h3>
                    <p>الدخول  للنظام</p>
                    <div class="buttons mt-5">
                        <a href="{{route('admins.login')}}" class="btn btn-primary">مدير  النظام </a>
                        <a href="{{route('ratingLogin')}}" class="btn btn-primary">   محكم المعايير البرمجية   </a>
                        <a href="{{route('ratingMokassyaLogin')}}" class="btn btn-primary">   محكم المعايير المؤسسية   </a>
                        <a href="{{route('login')}}" class="btn btn-primary">   الطلاب   </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
