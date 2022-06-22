$(function () {
    $("#change-password").validate({
        rules: {
            current_password: {
                required: true,
            },
            new_password: {
                required: true,
                minlength: 8
            },
            new_password_confirmation: {
                required: true,
                equalTo: "#new_password"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});