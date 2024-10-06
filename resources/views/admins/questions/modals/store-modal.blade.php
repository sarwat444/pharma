<div class="modal fade" id="create-new-college" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">أضافة سؤال جديد  </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('dashboard.questions.store')}}" id="store-new-category">
                    @csrf
                    <div class="mb-2">
                        <label for="name" class="col-form-label">السؤال </label>
                        <input type="text" name="name" placeholder="محتوى السؤال" class="form-control" id="name" required>
                    </div>

                    <div class="mb-2">
                        <label for="h_degree" class="col-form-label">الدرجه العظمى </label>
                        <input type="text" name="h_degree" placeholder="الدرجة العظمى" class="form-control" id="h_degree" required>
                    </div>

                    <input type="hidden" name="added_by" value="{{\Illuminate\Support\Facades\Auth::guard('admin')->id()}}">
                    <input type="hidden" name="teaching_outputs_id" value="{{$teaching_output->id}}">
                    <div class="mb-2 text-center">
                        <div class="spinner-border text-primary m-1 d-none" role="status"><span class="sr-only"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">تجاهل</button>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
