<script>
    $('.assign-permission-to-role').on('click', function () {
        let roleId = $(this).data('role-id');
        $.ajax({
            url: "{{route('dashboard.roles.permissions',':id')}}".replace(':id', roleId),
            method: "GET",
            success: function (response) {
                $('#role_name').text(response.data.role.name);
                $('#assign-permission-to-role-modal').modal('show');
                let permissionsDiv = $('#permissions');
                permissionsDiv.empty();
                if (response.data.permissions.length > 0) {
                    $.each(response.data.permissions, function (index, value) {
                        let isChecked = (value.checked) ? 'checked' : '';
                        $('#permissions').append(`<div class="col-6">
                            <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                <input class="form-check-input" name="permissions[]" value="${value.id}" type="checkbox" ${isChecked}>
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
                $('#form-edit-role-permissions').attr('action', "{{route('dashboard.roles.permissions.update',':id')}}".replace(':id', roleId));
            },
            error: function (response) {
                toast("error", 'Something went wrong');
            }
        });
    });
</script>
