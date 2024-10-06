<div class="modal fade" id="create-new-category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">أضافة أستبيان جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('dashboard.survey.store')}}" id="store-new-category">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="col-form-label">أسم الأستبيان </label>
                        <input type="hidden" value="{{$matarial_id}}" name="matarial_id">
                        <input type="text" name="name" placeholder="أسم الأستبيان" class="form-control" id="name"
                               required>
                    </div>
                    <div class="mb-3">
                    <label class="form-check-label" for="SwitchCheckSizelg">حالة الأستبيان</label>
                    <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                        <input class="form-check-input" type="checkbox" id="SwitchCheckSizelg" name="status" value="1" checked>
                    </div>
                    </div>
                    <div class="mb-3 text-center">
                        <div class="spinner-border text-primary m-1 d-none" role="status"><span class="sr-only"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">حفظ</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">تجاهل</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
