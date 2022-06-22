window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */


window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');

require('bootstrap');

/**
 * Next we will add all the vendor JS plugins required by our application.
 */
require('select2');
require('jquery-multifile');
require('jquery-validation');
require('datatables.net')(window, $);
require('datatables.net-bs4')(window, $);
require('perfect-scrollbar-ji/jquery')($);
require("intl-tel-input/build/js/intlTelInput-jquery");
require('jquery-bar-rating');
require('bootstrap-touchspin');
require('bootstrap-datetimepicker-npm');

window.Swal = require('sweetalert2');
window.moment = require('moment');
require('moment-timezone');
