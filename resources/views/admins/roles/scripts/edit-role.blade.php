<script>
    $(document).on('click', '.edit-role', function () {
        let roleId = $(this).data('role-id');
        let route = "{{route('dashboard.roles.edit',':id')}}";
        route = route.replace(':id', roleId);
        $.ajax({
            url: route,
            method: 'GET',
            success: function (response) {
                if (response.data) {
                    let route = "{{route('dashboard.roles.update',':id')}}";
                    route = route.replace(':id', response.data.id);
                    $('#form-edit-role').attr('action', route);
                    let modalEditRole = $('#editRoleModal');
                    modalEditRole.find('#name').val(response.data.name);
                    modalEditRole.modal('show');
                } else {
                    toast('error', 'role not found');
                }
            },
            error: function (response) {
                toast('error', 'an error occurred');
            }
        });
    });
</script>
