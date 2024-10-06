<script>
    $('#form-edit-role').on('submit', function (event) {
        event.preventDefault();
        $(this).find(".spinner-border").removeClass('d-none');
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize(),
            success: function (response) {
                $(".spinner-border").addClass('d-none');
                location.reload();
                toast(response.type, response.message);
            },
            error: function (response) {
                $(".spinner-border").addClass('d-none');
                $.each(response.responseJSON.errors, function (key, value) {
                    toast("error", value[0]);
                });
            }
        });
    });
</script>
