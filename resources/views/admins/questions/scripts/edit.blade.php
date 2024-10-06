<script>
    $(document).on('click', '.edit', function () {
        let categoryId = $(this).data('category-id');
        let route = "{{route('dashboard.questions.edit',':id')}}";
        route = route.replace(':id', categoryId);
        $.ajax({
            url: route,
            method: 'GET',
            success: function (response) {
                if (response.data) {
                    console.log(response.data) ;
                    let route = "{{route('dashboard.questions.update',':id')}}";
                    route = route.replace(':id', response.data.id);
                    $('#form-edit-category').attr('action', route);
                    let modalEditCategory = $('#editCategoryModal');
                    modalEditCategory.find('#name').val(response.data.name);
                    modalEditCategory.find('#h_degree').val(response.data.h_degree);
                    modalEditCategory.modal('show');
                } else {
                    toast('error', 'question not found');
                }
            },
            error: function (response) {
                toast('error', 'an error occurred');
            }
        });
    });
</script>
