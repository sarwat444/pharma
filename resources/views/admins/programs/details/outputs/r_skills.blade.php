@extends('admins.layouts.app')

@push('title', 'المعايير الأكاديمية'))
@push('styles')
    <link href="{{ asset(PUBLIC_PATH . '/assets/admin/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset(PUBLIC_PATH.'/assets/admin/css/program_details.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset(PUBLIC_PATH.'/assets/admin/css/abilities.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    @include('admins.programs.details.includes.program_sidebar')
                </div>
            </div>
        </div>
        <div class="col-md-8">
            @include('admins.programs.details.includes.output_sidebar')
            <div class="card mb-2">
                <div class="card-body">
                    <div class="card-title"> العلمات المرجعيه </div>
                    <div class="row mb-3">
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="abilaites" placeholder="أضافه  معاير أكاديمية "
                                   required>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary">حفظ</button>
                        </div>
                    </div>
                    <table class="table table-responsive table-bordered table-striped">
                        <thead>
                        <th>#</th>
                        <th> عناصر المعرفه والفهم</th>
                        <th>التحكم</th>
                        </thead>
                        <tbody>
                        <tr>
                            <td> 1</td>
                            <td>
                                <p>عرض عناصر الفهم والمعرفه عنصر </p>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="#" data-category-id="#" class="text-muted font-size-20 "><i
                                            class="bx bxs-edit"></i></a>
                                    <form action="#" method="POST">@csrf @method('delete')
                                        <a class="text-muted font-size-20 confirm-delete"><i
                                                class="bx bx-trash"></i></a>
                                    </form>
                                </div>
                            </td>

                        </tr>
                        </tbody>

                    </table>
                </div>

            </div>
            @endsection
            @push('scripts')
                <script src="{{ asset(PUBLIC_PATH . '/assets/admin/libs/sweetalert2/sweetalert2.min.js') }}"></script>
                <script src="{{ asset(PUBLIC_PATH . '/assets/admin/js/pages/sweet-alerts.init.js') }}"></script>
    @endpush

