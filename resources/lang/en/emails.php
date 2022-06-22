<?php

return [
    'salutation' => 'Hello :Name',
    'regards' => 'Thanks,',
    'messages' => [
        'new' => [
            'message' => 'You have a new message from :Sender',
            'cta' => 'View Messages'
        ]
    ],
    'orders' => [
        'accepted' => [
            'message' => 'Order #:orderId has been automatically accepted after stipulated 14 day waiting period.'
        ],
        'placed' => [
            'message' => 'We have received your order #:orderId and one of our talented writers will begin working on it immediately.
Thank you for trusting us with your custom essay writing needs, and we will endeavor to submit a top-notch essay promptly.'
        ],
        'submitted' => [
            'message' => [
                'p1' => 'We are pleased to inform you that the order #:orderId you placed with us has been completed.
Please log in to your account and review the document.',
                'p2' => 'We welcome any concerns you may have regarding the paper and will be most obliged to make the necessary amendments.',
                'p3' => 'Thank you for your continued faith in our service'
            ],
            'cta' => 'View order'
        ]
    ],
    'registration' => [
        'confirm' => [
            'message' => [
                'p1' => 'Congratulations! Your account has been created successfully :appName.',
                'p2' => 'Check your email, for our confirmation link to complete registration.',
            ],
            'cta' => 'Confirm Account'
        ],
        'welcome' => [
            'message' => [
                'p1' => 'Congratulations! ',
                'p2' => 'Your account has been created successfully.',
                'p3' => 'Click your email, for our confirmation link to complete registration.'
            ]
        ]
    ],
    'users' => [
        'activated' => [
            'message' => [
                'p1' => 'After much consideration from your appeal, your account is now activated. Please strive to adhere to our terms of service.',
                'p2' => 'You can now log in to your account, and see the available orders.',
            ]
        ],
        'deactivated' => [
            'message' => [
                'p1' => 'Your account has been deactivated.',
                'p2' => 'After careful consideration, we have found you in violation of our terms of service.',
                'p3' => 'Kindly note that this verdict is final, and nothing can be done to salvage the account.'
            ]
        ],
        'suspended' => [
            'message' => [
                'p1' => 'Your account has been suspended.',
                'p2' => 'After careful consideration, we have found you in violation of our term of service. Your account is under review
and may be reinstated after three months.',
                'p3' => 'Please contact customer support for any concerns.'
            ]
        ],
        'unsuspended' => [
            'message' => [
                'p1' => 'Your account’s suspension status has been lifted. Kindly consider the probation period as a warning, and strive to
adhere to our terms of service.',
                'p2' => 'You can now log in to your account, and see the available orders.',
            ]
        ]
    ]
];
