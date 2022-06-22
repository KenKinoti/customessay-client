<?php 
return [
  'salutation' => '你好 :Name',
  'regards' => '谢谢，',
  'messages' => [
    'new' => [
      'message' => '您收到来自 :Sender的新消息',
      'cta' => '查看讯息',
    ],
  ],
  'orders' => [
    'accepted' => [
      'message' => '在指定的14天等待期后，订单＃：orderId已自动接受。',
    ],
    'placed' => [
      'message' => '我们已经收到您的订单＃：orderId，我们的一位有才华的作家将立即开始工作。
感谢您信任我们的自定义论文写作需求，我们将努力尽快提交一流的论文。',
    ],
    'submitted' => [
      'message' => [
        'p1' => '我们很高兴通知您，您与我们下的订单＃：oderId已完成。
请登录到您的帐户并查看文档。',
        'p2' => '我们欢迎您对本文有任何疑问，并且最有义务进行必要的修改。',
        'p3' => '感谢您一直以来对我们服务的信念',
      ],
      'cta' => '查看订单',
    ],
  ],
  'registration' => [
    'confirm' => [
      'message' => [
        'p1' => '我们很高兴欢迎您来到 :appName。',
        'p2' => '确认此处最终成为我们美好社区的一部分。',
        'p3' => '如果您不要求加入我们，请忽略此消息。我们很高兴有您！',
      ],
      'cta' => '确认帐号',
    ],
    'welcome' => [
      'message' => [
        'p1' => '欢迎使用 :appName。',
        'p2' => '我们很高兴您决定加入我们。',
        'p3' => '感谢您的信任并给我们提供为您服务的机会。',
      ],
    ],
  ],
  'users' => [
    'activated' => [
      'message' => [
        'p1' => '经过您的上诉深思熟虑，您的帐户现已激活。请努力遵守我们的服务条款。',
        'p2' => '现在，您可以登录到您的帐户，并查看可用的订单。',
      ],
    ],
    'deactivated' => [
      'message' => [
        'p1' => '您的帐户已被停用。',
        'p2' => '经过仔细考虑，我们发现您违反了我们的服务条款。',
        'p3' => '请注意，此裁决是最终裁决，无法挽回该帐户。',
      ],
    ],
    'suspended' => [
      'message' => [
        'p1' => '您的帐户已被暂停。',
        'p2' => '经过仔细考虑，我们发现您违反了我们的服务条款。您的帐户正在审核中
并且可以在三个月后恢复。',
        'p3' => '如有任何疑问，请联系客户支持。',
      ],
    ],
    'unsuspended' => [
      'message' => [
        'p1' => '您帐户的暂停状态已解除。请您将试用期视为警告，并努力做到
遵守我们的服务条款。',
        'p2' => '您现在可以登录到您的帐户，并查看可用的订单。',
      ],
    ],
  ],
];