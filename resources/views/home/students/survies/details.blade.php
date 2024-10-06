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
                    <h3 class="text-center font-size-14 mb-4">أستبيان طلابى عن المقرر</h3>
                    <div class="card-title text-center fw-bold text-primary">{{ $survey->name }}</div>

                    <form method="POST" action="{{ route('home.student-survey.store') }}">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>بنود التقييم</th>
                                    <th>ضعيف جدا</th>
                                    <th>ضعيف</th>
                                    <th>مقبول</th>
                                    <th>جيد</th>
                                    <th>ممتاز</th>
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
                                            <td><input type="radio" name="answers[{{ $question->id }}]" value="1" required></td>
                                            <td><input type="radio" name="answers[{{ $question->id }}]" value="2" required></td>
                                            <td><input type="radio" name="answers[{{ $question->id }}]" value="3" required></td>
                                            <td><input type="radio" name="answers[{{ $question->id }}]" value="4" required></td>
                                            <td><input type="radio" name="answers[{{ $question->id }}]" value="5" required></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">لا يوجد أسئلة بالمحور</td>
                                        </tr>
                                    @endforelse
                                @empty
                                    <tr>
                                        <td colspan="6">لا يوجد محاور</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary btn-block">إرسال</button>
                        </div>
                    </form>


                </div>
            </div>

        </div>
    </div>

@endsection
@push('scripts')
@endpush
