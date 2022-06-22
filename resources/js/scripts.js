require('./vendor');
require('./forms');
require('./nav/page');
require('./nav/sidebar');
require('./datatables/experts');
require('./plugins/lazysizes.min');
require('./messages/messages');

Number.prototype.formatMoney = function (c, d, t) {
    let n = this,
        cc = isNaN(c = Math.abs(c)) ? 2 : c,
        de = d === undefined ? "." : d,
        th = t === undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = parseInt(n = Math.abs(+n || 0).toFixed(cc)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + th : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + th) + (cc ? de + Math.abs(n - i).toFixed(cc).slice(2) : "");
};

$(document).ready(function () {
    //  Activate the Tooltips
    $('[data-toggle="tooltip"], [rel="tooltip"]').tooltip();

    // Activate Datepicker
    if ($('.datepicker').length != 0) {
        $('.datepicker').datetimepicker({
            weekStart: 1
        });
    }
    // Activate Popovers
    $('[data-toggle="popover"]').popover({container: "body"});

    // Activate select 2
    $('select.form-control').select2({width: null});

    // Validate form on select
    $('select').on('select2:select', function (e) {
        $(this).valid();
    });

    // Validate form
    $("form.validate-form").each(function (index, form) {
        $(form).validate();
    });

    // Touchspin
    $(".zero-spin").TouchSpin({
        min: 0,
    });

    // Rating
    $('#rating').barrating({
        theme: 'css-stars'
    });

    $('.timezone').val(moment.tz.guess());

    // Make order rows click able.
    $("body").on("click", ".dataTable .dt-order-item", function () {
        window.location = $(this).data("href");
    });

    // Custom radio buttons
    $(document).on('click', '.radio-btn', function () {
        $('#' + $(this).attr('data-target')).val($(this).attr('data-option')).change();
        var siblings = $(this).parent().children();
        $.each(siblings, function (key, value) {
            $(value).removeClass('active');
        });
        $(this).addClass('active');
    });

    $(document).find('.radio-btn.active').each(function (index, element) {
        $('#' + $(element).attr('data-target')).val($(element).attr('data-option')).change();
    });

    // Handle setting the active class on menu
    let url = window.location;
    $('ul.nav a').filter(function () {
        return this.href == url;
    }).parent().addClass('active');

    $(document).ajaxError(function (event, jqxhr, settings, exception) {
        if (exception === 'Unauthorized') {
            Swal({
                title: "Session Time Out",
                text: "Your session has timed out, Please log in again.",
                type: "warning",
            }).then(() => {
                window.location.replace('/login');
            });
        } else {
            console.log(exception);
        }
    });

    $.fn.dataTable.ext.errMode = 'none';
});
   if($('.collapse').length){
        var hash = window.location.hash;

        if(hash.length>0){
            $(hash+".collapse").addClass('show')
    }
   
        }