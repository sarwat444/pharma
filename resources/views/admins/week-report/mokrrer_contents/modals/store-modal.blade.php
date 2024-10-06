

<div class="modal fade" id="create-new-category22" tabindex="-1" aria-labelledby="exampleModalLabel22" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel22">أضافة محتوى المقرر   </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('dashboard.week_mokrrer_contents.store')}}" id="store-new-category22">
                    @csrf
                    <div class="mb-2">
                        <label for="goal" class="col-form-label">أسم المحتوى </label>
                        <input type="text" name="name" placeholder="أسم  المحتوى " class="form-control" id="name" required>
                        <input type="hidden" name="matarial_id" value="{{$matarial->id}}">
                        <input type="hidden" name="added_by" value="{{Auth()->id()}}">
                        <input type="hidden" name="week_number" value="{{$week_number}}">
                        <input type="hidden" name="main_type" value="week_report">
                    </div>
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
