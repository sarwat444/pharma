@extends('admins.layouts.app')

@push('title', 'الأستبيان')
@push('styles')
    <link href="{{ asset(PUBLIC_PATH . '/assets/admin/css/survey.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="row">
       <div class="col-md-12">
           <h3 class="font-size-16 fw-bold mb-4" style="text-align: right">المقرر :: {{$matarial->name}}  </h3>
       </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center font-size-14 mb-4"> أستبيان طلابى عن المقرر</h3>
                    <div class="card-title text-center fw-bold text-primary">{{ $survey->name }}</div>
                    <div class="table-responsive">
                        <table class="table table-bordered ">
                            <thead>
                            <tr>
                                <th>بنود التقييم</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($survey->categories as $category)
                                <tr>
                                    <td colspan="6" class="fw-bold" style="text-align: right">{{ $category->name }}</td>
                                </tr>
                                @forelse($category->questions as $question)
                                    <tr>
                                        <td>{{ $question->name }}</td>
                                    </tr>
                                @empty
                                @endforelse
                            @empty
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
@endpush
