<script>
    $(document).on('click', '.edit-permission', function () {
        let permissionId = $(this).data('permission-id');
        let route = "{{route('dashboard.permissions.edit',':id')}}";
        route = route.replace(':id', permissionId);
        $.ajax({
            url: route,
            method: 'GET',
            success: function (response) {
                if (response.data) {
                    let route = "{{route('dashboard.permissions.update',':id')}}";
                    route = route.replace(':id', response.data.id);
                    $('#form-edit-permission').attr('action', route);
                    let modalEditPermission = $('#editPermissionModal');
                    modalEditPermission.find('#name').val(response.data.name);
                    modalEditPermission.modal('show');
                } else {
                    toast('error', 'permission not found');
                }
            },
            error: function (response) {
                toast('error', 'an error occurred');
            }
        });
    });
</script>
