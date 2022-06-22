<?php

return [

    /*
     |--------------------------------------------------------------------------
     | Currency
     |--------------------------------------------------------------------------
     |
     | This option controls the default currency used in the application.
     |
     */

    'currency' => env('APP_CURRENCY', '$'),

    /*
     |--------------------------------------------------------------------------
     | Contact Email
     |--------------------------------------------------------------------------
     |
     | This option controls the default email used by the contact form.
     |
     */
    'contact_email' => env('MAIL_CONTACT'),

    /*
     |--------------------------------------------------------------------------
     | User Type
     |--------------------------------------------------------------------------
     |
     | This option controls the default user type that applies to the site.
     |
     */
    'user_type' => 'Client',

    /*
     |--------------------------------------------------------------------------
     | DISCUSS NAME
     |--------------------------------------------------------------------------
     |
     | This option controls the default name for the discuss comments.
     |
     */
    'discuss_name' => env('DISCUSS_NAME'),

    /*
     |--------------------------------------------------------------------------
     | DATE FORMAT
     |--------------------------------------------------------------------------
     |
     | The global date format to be displayed.
     |
     */
    'date_format' => 'd M, Y',

    /*
     |--------------------------------------------------------------------------
     | TIME FORMAT
     |--------------------------------------------------------------------------
     |
     | The global time format to be displayed.
     |
     */
    'time_format' => 'h:i A',

    /*
     |--------------------------------------------------------------------------
     | TIME FORMAT
     |--------------------------------------------------------------------------
     |
     | The global time format to be displayed.
     |
     */
    'date_time_format' => 'd M, Y h:i A',
];
