<script>
    $(document).on('click', '.edit', function () {
        let categoryId = $(this).data('category-id');
        let route = "{{route('dashboard.structures.edit',':id')}}";
        route = route.replace(':id', categoryId);
        $.ajax({
            url: route,
            method: 'GET',
            success: function (response) {
                if (response.data) {
                    let route = "{{route('dashboard.structures.update',':id')}}";
                    route = route.replace(':id', response.data.id);
                    $('#form-edit-category').attr('action', route);
                    let modalEditCategory = $('#editCategoryModal');
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
