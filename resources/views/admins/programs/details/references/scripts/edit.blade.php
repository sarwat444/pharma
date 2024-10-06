<script>
    $(document).on('click', '.edit', function () {
        let categoryId = $(this).data('category-id');
        let route = "{{route('dashboard.references.edit',':id')}}";
        route = route.replace(':id', categoryId);
        $.ajax({
            url: route,
            method: 'GET',
            success: function (response) {
                if (response.data) {
                    let route = "{{route('dashboard.references.update',':id')}}";
                    route = route.replace(':id', response.data.id);
                    $('#form-edit-category').attr('action', route);
                    let modalEditCategory = $('#editCategoryModal');
                    modalEditCategory.find('#goal').val(response.data.name);
                    modalEditCategory.modal('show');
                } else {
                    toast('error', 'الهدف ليس  موجود ');
                }
            },
            error: function (response) {
                toast('error', 'an error occurred');
            }
        });
    });
</script>
