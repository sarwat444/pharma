<script>
    $("#store-new-permission").submit(function (event) {
        event.preventDefault();
        $(this).find(".spinner-border").removeClass('d-none');
        $.ajax({
            'url': $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            success: function (data) {
                $(".spinner-border").addClass('d-none');
                location.reload();
                toast(data.type,data.message);
            },
            error: function (data) {
                $(".spinner-border").addClass('d-none');
                $.each(data.responseJSON.errors, function (key, value) {
                    toast("error", value[0]);
                });
            },
        });
    });
</script>