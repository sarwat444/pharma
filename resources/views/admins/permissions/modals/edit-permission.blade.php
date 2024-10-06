<div class="modal fade" id="editPermissionModal" tabindex="-1" aria-labelledby="editPermissionModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('dashboard.edit permission')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form-edit-permission">
                    @method('PUT')
                    @csrf
                    <div class="mb-2">
                        <label for="name" class="col-form-label">{{__('dashboard.permission name')}}:</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="{{__('dashboard.permission name')}}" required>
                    </div>

                    <div class="mb-2 text-center">
                        <div class="spinner-border text-primary m-1 d-none" role="status"><span class="sr-only"></span></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('dashboard.close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('dashboard.save')}}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
