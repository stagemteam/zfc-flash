<?php

namespace Stagem\ZfcFlash;


return [
    'dependencies' => [
        'factories' => [
            FlashInterface::class => Adapter\Factory\SlimFlashAdapterFactory::class,
        ]
    ],
    'view_helpers' => [
        'factories' => [
            \Zend\View\Helper\FlashMessenger::class => View\Helper\Factory\FlashMessengerFactory::class,
        ],
    ],
    'view_helper_config' => [
        'flashmessenger' => [
            'message_open_format' => '<div%s><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><ul><li>',
            'message_close_string' => '</li></ul></div>',
            'message_separator_string' => '</li><li>',
        ],
    ],
    // middleware
    'templates' => [
        'paths' => [
            'widget' => [__DIR__ . '/../view/widget'],
        ],
    ],
];