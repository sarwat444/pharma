

<div class="modal fade" id="create-new-category88" tabindex="-1" aria-labelledby="exampleModalLabel88" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel88">أضافة الأدلة والشواهد   </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('dashboard.week_invoices.store')}}" id="store-new-category88" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-2">
                        <label for="goal" class="col-form-label">محتوى الدليل </label>
                        <input type="text" name="name" placeholder="أسم  المحتوى " class="form-control" id="name" required>
                        <input type="hidden" name="matarial_id" value="{{$matarial->id}}">
                        <input type="hidden" name="added_by" value="{{Auth()->id()}}">
                        <input type="hidden" name="week_number" value="{{$week_number}}">
                    </div>
                    <div class="mb-2">
                        <label for="goal" class="col-form-label"> الدليل </label>
                        <input type="file" name="file_path" placeholder="أسم  المحتوى " class="form-control" id="name" required>
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
