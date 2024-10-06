<script>
    $(document).on('click', '.edit-user', function () {
        let adminId = $(this).data('admin-id');
        let route = "{{route('dashboard.admins.edit',':id')}}";
        route = route.replace(':id', adminId);
        $.ajax({
            url: route,
            method: 'GET',
            success: function (response) {
                if (response.data) {
                    let route = "{{route('dashboard.admins.update',':id')}}";
                    route = route.replace(':id', response.data.id);
                    $('#form-edit-user').attr('action', route);
                    let modalEditUser = $('#editUserModal');
                    modalEditUser.find('#name').val(response.data.name);
                    modalEditUser.find('#email').val(response.data.email);
                    modalEditUser.modal('show');
                } else {
                    toast('error', 'user not found');
                }
            },
            error: function (response) {
                toast('error', 'an error occurred');
            }
        });
    });
</script>
