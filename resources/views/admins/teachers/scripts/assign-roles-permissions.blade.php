<script>
    $(document).on('click', 'body .edit-roles-permissions', function () {
        let adminId = $(this).data('admin-id');
        let url = "{{route('dashboard.admins.roles.permissions.edit',':id')}}";
        url = url.replace(':id', adminId);
        $.ajax({
            url: url,
            method: "GET",
            success: function (response) {

                let permissionsDiv = $('#permissions');
                permissionsDiv.empty();
                if (response.data.permissions.length > 0) {
                    $.each(response.data.permissions, function (index, value) {
                        let isChecked = (value.checked) ? 'checked' : '';
                        $('#permissions').append(`<div class="col-6">
                            <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                <input class="form-check-input" name="permissions[]" value="${value.name}" type="checkbox" ${isChecked}>
                                <label class="form-check-label">${value.name}</label>
                            </div>
                        </div>`);
                    });
                } else {
                    permissionsDiv.append(`<div class="col-12">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-block-helper me-2"></i>
                            no permissions founded yet!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>`);
                }

                let rolesDiv = $('#roles');
                rolesDiv.empty();
                if (response.data.roles.length > 0) {
                    $.each(response.data.roles, function (index, value) {
                        let isChecked = (value.checked) ? 'checked' : '';
                        $('#roles').append(`<div class="col-6">
                            <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                <input class="form-check-input" name="roles[]" value="${value.id}" type="checkbox" ${isChecked}>
                                <label class="form-check-label">${value.name}</label>
                            </div>
                        </div>`);
                    });
                } else {
                    rolesDiv.append(`<div class="col-12">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-block-helper me-2"></i>
                            no roles founded yet!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>`);
                }

                $('#form-assign-roles-permissions').attr('action', "{{route('dashboard.admins.permissions.roles.update',':id')}}".replace(':id', adminId));
                $('#assign-roles-permissions-to-admin').modal('show');
            },
            error: function (response) {
                toast('error', 'something went wrong');
            }
        });
    });
</script>
