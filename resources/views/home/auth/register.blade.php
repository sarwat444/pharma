@extends('home.auth.layouts')
@push('title','تسجيل الدخول للطلاب')
<style>
    body , html
    {
        direction: rtl;
        text-align: right;
    }
    body{
        direction: rtl;
        font-family: 'Noto Kufi Arabic', sans-serif;
        background-image: linear-gradient(#0c3f77f2, #0f4e93c7), url({{asset(PUBLIC_PATH.'assets/site/images/background.jpg')}});
        background-size: cover;
        background-position: center;
    }
</style>
@section('content')
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-6 text-center">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <img style="height: 95px" class="mb-3" src="{{asset(PUBLIC_PATH.'assets/site/images/main-logo.png')}}">
                                    <h3 class="text-center font-size-17 mt-4" style="font-weight: bold;">  نظام إتقان - أدارة نظام الجوده</h3>
                                    <p class="text-primary text-center">تسجيل دخول -  الطلاب </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="p-2 text-center">
                                <div class="mb-1">
                                </div>
                            </div>
                            <div class="p-2">
                                <form class="form-horizontal" action="{{ route('register.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3" style="text-align: right">
                                        <label for="name" class="form-label">الأسم بالكامل</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="الأسم بالكامل" value="{{ old('name') }}">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="mb-3" style="text-align: right">
                                        <label for="class" class="form-label">الفرقة</label>
                                        <input type="text" name="class" class="form-control @error('class') is-invalid @enderror" id="class" placeholder="الفرقة" value="{{ old('class') }}">
                                        @error('class')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="mb-3" style="text-align: right">
                                        <label for="email" class="form-label">الأيميل</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="الأيميل" value="{{ old('email') }}">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="mb-3" style="text-align: right">
                                        <label class="form-label">الباسورد</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="الرقم السري">
                                            <button class="btn btn-light" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                        </div>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="mb-3" style="text-align: right">
                                        <label class="form-label">تاكيد الباسورد</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="تأكيد الرقم السري">
                                            <button class="btn btn-light" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                        </div>
                                    </div>
                                    <div class="mt-3 d-grid">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">تسجيل</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
