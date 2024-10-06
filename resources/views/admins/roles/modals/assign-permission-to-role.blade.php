<div class="modal fade" id="assign-permission-to-role-modal" tabindex="-1" aria-labelledby="assign-permission-to-role-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('dashboard.assign permissions to role')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form-edit-role-permissions">
                    @method('PUT')
                    @csrf
                    <div class="mb-2">
                        <label class="col-form-label">{{__('dashboard.role name')}}: <p id="role_name" class="badge badge-soft-primary"></p></label>
                    </div>

                    <div class="mb-2">
                        <label class="col-form-label">{{__('dashboard.permissions')}}</label>
                        <div class="row" id="permissions">
                        </div>

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