<script>
    $('.assign-role-to-permission').on('click', function () {
        let permissionId = $(this).data('permission-id');
        $.ajax({
            url: "{{route('dashboard.permissions.roles',':id')}}".replace(':id', permissionId),
            method: "GET",
            success: function (response) {
                $('#permission_name').text(response.data.permission.name);
                $('#assign-role-to-permission-modal').modal('show');
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
                $('#form-edit-permission-roles').attr('action', "{{route('dashboard.permissions.roles.update',':id')}}".replace(':id', permissionId));
            },
            error: function (response) {
                toast("error", 'Something went wrong');
            }
        });
    });
</script>
