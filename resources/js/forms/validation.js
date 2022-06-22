// Set jQuery Validation Defaults
jQuery.validator.setDefaults({
    errorElement: 'span',
    errorClass: 'invalid-feedback',
    focusInvalid: false,

    errorPlacement: function (error, element) {
        if (element.attr('type') === 'radio' || element.attr('type') === 'checkbox') {
            $(element).closest('div').parent().append(error);
        } else {
            $(element).closest('div').append(error);
        }
    },

    highlight: function (element) {
        $(element).closest('.form-control').addClass('is-invalid').removeClass('is-valid');
    },

    unhighlight: function (element) {
        $(element).closest('.form-control').removeClass('is-invalid').removeClass('is-valid');
    },

    success: function (label, element) {
        $(element).addClass('is-valid').removeClass('is-invalid');
        $(element).closest('.invalid-feedback').remove();
    }
});