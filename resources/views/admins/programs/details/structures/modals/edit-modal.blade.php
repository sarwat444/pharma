<div class="modal fade text-left" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="modal-reload">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تعديل هيكل مكونات البرنامج  </h5>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="form-edit-category" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="goal">  هيكل مكونات البرنامج </label>
                        <input type="file" name="file_path"  class="form-control" id="name" required>
                    </div>
                    <div class="form-group text-center mt-2">
                        <button id="modal-blockui" type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

