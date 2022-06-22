$(function () {
    if($("#editProfile").length > 0){
        let countryData = window.intlTelInputGlobals.getCountryData(),
            telInput = $("#phone"),
            countries = $("#countryCode");

        telInput.intlTelInput(telInput, {
            nationalMode: true,
            utilsScript: require('intl-tel-input/build/js/utils')
        });

        $.each(countryData, function (i, country) {
            countries.append($("<option></option>").attr("value", country.iso2).text(country.name));
        });

        let initialCountry = telInput.intlTelInput("getSelectedCountryData").iso2;
        countries.val(initialCountry);


        telInput.on("countrychange", function () {
            countries.val(telInput.intlTelInput("getSelectedCountryData").iso2);
            countries.trigger('change');
        });

        countries.change(function () {
            telInput.intlTelInput("setCountry", $(this).val());
            telInput.valid()
        });


        jQuery.validator.addMethod("validPhone", function () {
            return telInput.intlTelInput("isValidNumber");
        }, 'Please enter a valid phone number.');

        $("#editProfile").validate({
            rules: {
                phone: {
                    required: true,
                    validPhone: true
                },
                countryCode: {
                    required: true,
                }
            },
            messages: {
                email: {
                    remote: "This email already exists"
                }
            },
            errorPlacement: function (error, element) {
                if (element.prop("name") === "avatar") {
                    $("#avatar-error").html(error);
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                $("#phoneNumber").val($("#phone").intlTelInput("getNumber"));
                form.submit();
            }
        });
    }
});
