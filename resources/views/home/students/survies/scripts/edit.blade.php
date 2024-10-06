<script>
    $(document).on('click', '.edit', function () {
        let categoryId = $(this).data('category-id');
        let route = "{{route('dashboard.survey.edit',':id')}}";
        route = route.replace(':id', categoryId);
        $.ajax({
            url: route,
            method: 'GET',
            success: function (response) {
                if (response.data) {
                    let route = "{{route('dashboard.survey.update',':id')}}";
                    route = route.replace(':id', response.data.id);
                    $('#form-edit-category').attr('action', route);
                    let modalEditCategory = $('#editCategoryModal');
                    modalEditCategory.find('#name').val(response.data.name);
                    modalEditCategory.find('#status').val(response.data.status);
                    modalEditCategory.modal('show');
                } else {
                    toast('error', 'category not found');
                }
            },
            error: function (response) {
                toast('error', 'an error occurred');
            }
        });
    });
</script>
