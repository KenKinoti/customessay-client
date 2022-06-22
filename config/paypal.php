<?php

return [

    'mode' =>env('PAYPAL_MODE', 'sandbox'),
    'sandbox' => [
        'client_id' => env('PAYPAL_SANDBOX_API_CLIENT_ID', ''),
        'secret' => env('PAYPAL_SANDBOX_API_SECRET', '')
    ],
    'live' => [
        'client_id' => env('PAYPAL_LIVE_API_CLIENT_ID', ''),
        'secret' => env('PAYPAL_LIVE_API_SECRET', '')
    ],
    'log' => [
        'enabled' => true,
        'file_name' => 'payPal.log',
        'level' => 'DEBUG'
    ]
];
