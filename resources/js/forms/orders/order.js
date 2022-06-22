require('./calculator');

let select = '<select name="$file" class="file-options input">' +
    '<option value="">--Select Description--</option>' +
    '<option value="Order instructions">Order instructions</option>' +
    '<option value="Guidelines for writing">Guidelines for writing</option>' +
    '<option value="Outline">Outline</option>' +
    '<option value="Template">Template</option>' +
    '<option value="My draft">My draft</option>' +
    '<option value="Sample of paper">Sample of paper</option>' +
    '<option value="Article to be used">Article to be used</option>' +
    '<option value="eBook">eBook</option>' +
    '<option value="Paper with comments for revision/editing">Paper with comments for revision/editing</option>' +
    '<option value="Proposal">Proposal</option>' +
    '<option value="Questions">Questions</option>' +
    '<option value="Chapters">Chapters</option>' +
    '<option value="Sources (list)">Sources (list)</option>' +
    '<option value="Grading rubric">Grading rubric</option>' +
    '<option value="Lecture notes to be used">Lecture notes to be used</option>' +
    '</select>';

$(function () {
    $('#files').MultiFile({
        list: '.files-list',
        STRING: {
            remove: '<i class="ti ti-trash"></i>',
            file: '$file ' + select,
        }
    });

    $('[data-toggle="wizard-radio"]').click(function () {
        wizard = $(this).closest('#paymentMethods');
        wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
        $(this).addClass('active');
        $(wizard).find('[type="radio"]').removeAttr('checked');
        $(this).find('[type="radio"]').attr('checked', 'true');

        $("[name='payment_method']").valid();
    });

    $('[data-toggle="wizard-checkbox"]').click(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $(this).find('[type="checkbox"]').removeAttr('checked');
        } else {
            $(this).addClass('active');
            $(this).find('[type="checkbox"]').attr('checked', 'true');
        }
    });

    // Check when the citation changes
    $("input[name=citation_id]").on('change', function () {
        if ($(this).val() === "other") {
            $("#other_citation").show();
            $("#other_citation").val('');
            $("input[name=citation_id]").valid();
            $("input[name=other_citation]").valid();
        } else {
            $("#other_citation").hide();
            $("#other_citation").val('');
            $("input[name=citation_id]").valid();
            $("input[name=other_citation]").valid();
        }
    });

    $("input[name=other_citation]").on('change', function () {
        $("input[name=citation_id]").valid();
    });

    // Disable account inputs
    $('a[data-target="#new"]').on('shown.bs.tab', function (e) {
        $("#return input").prop('disabled', true);
        $("#new input").removeAttr('disabled');
    });

    $('a[data-target="#return"]').on('shown.bs.tab', function (e) {
        $("#new input").prop('disabled', true);
        $("#return input").removeAttr('disabled');
    });

    // Update topic when changed
    $('.topic-text').text($("#topic").val());
    $("#topic").on('keyup', function () {
        $('.topic-text').text($(this).val());
    });

    let locale = $('html').attr('lang');

    $('#orderForm').validate({
        focusInvalid: true,

        rules: {
            academic_level_id: {
                required: true
            },
            paper_type_id: {
                required: true
            },
            discipline_id: {
                required: true
            },
            instructions: {
                required: true
            },
            topic: {
                required: true,
                maxlength: 255
            },
            spacing: {
                required: true
            },
            deadline_id: {
                required: true
            },
            citation_id: {
                required: true
            },
            other_citation: {
                required: true,
                maxlength: 255
            },
            pages: {
                required: true,
                min: 0,
                max: 99
            },
            sources: {
                number: true,
                min: 0
            },
            writer_id: {
                maxlength: 255,
                remote: {
                    url: window.location.protocol + "//" + window.location.hostname  + "/check-writer",
                    type: "post",
                    data: {
                        _token: $('meta[name=csrf-token]').attr('content')
                    }
                }
            },
            name: {
                required: true,
                maxlength: 255
            },
            email: {
                required: true,
                email: true,
                maxlength: 255,
                remote: {
                    url: window.location.protocol + "//" + window.location.hostname + "/check-email",
                    type: "post",
                    data: {
                        _token: $('meta[name=csrf-token]').attr('content')
                    }
                }
            },
            password: {
                required: true,
                minlength: 8,
                maxlength: 255,
            },
            password_confirmation: {
                required: true,
                equalTo: "#password",
            },
            login_email: {
                required: true,
                email: true
            },
            login_password: {
                required: true
            },
            payment_method: {
                required: true,
                remote: {
                    url: window.location.protocol + "//" + window.location.hostname +  "/check-wallet",
                    type: "post",
                    data: {
                        _token: $('meta[name=csrf-token]').attr('content'),
                        amount: function () {
                            return $("#totalAmount").val();
                        }
                    }
                }
            }
        },
        messages: {
            email: {
                remote: "This email already exists"
            },
            writer_id: {
                remote: "Please enter a valid writer ID."
            },
            payment_method: {
                required: "Please select a payment method.",
                remote: "Insufficient funds, please select another method."
            }
        },
        errorPlacement: function (error, element) {
            if (element.prop('name') === 'payment_method') {
                $("#payment-method-error").text(error.text());
            } else if (element.attr('type') === 'radio' || element.attr('type') === 'checkbox') {
                $(element).closest('div').parent().append(error);
            } else {
                $(element).closest('div').append(error);
            }

            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});
