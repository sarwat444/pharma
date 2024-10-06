<div class="modal fade" id="create-new-college" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">أضافة  معيار جديد </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('dashboard.MayearMokassy.store')}}" id="store-new-category">
                    @csrf
                    <div class="mb-2">
                        <label for="name" class="col-form-label">المعيار</label>
                        <input type="text" name="name" placeholder="أسم المعيار" class="form-control" id="name" required>
                        <input type="hidden" name="college_id" value="{{$college->id}}">
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
