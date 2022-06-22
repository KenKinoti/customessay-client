$(function () {
    let locale = $('html').attr('lang');

    $("#register").validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            email: {
                required: true,
                email: true,
                remote: {
                    type: "POST",
                    url: window.location.protocol + "//" + window.location.hostname + "/" + locale + "/check-email",
                    data: {
                        _token: $('meta[name=csrf-token]').attr('content')
                    }
                },
                maxlength: 255
            },
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            }
        },
        messages: {
            email: {
                remote: "This email already exists"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});
