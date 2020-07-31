<?php return [
    'plugin' => [
        'name' => 'Multi-locale customizations',
        'description' => 'Customizations for RainLab.Translate plugin functionality',
    ],
    'translate' => [
        'change_locale' => 'Change Locale',
    ],
    'permission' => [
        'manage_settings' => [
            'label' => 'Manage customizations to multi-locale behavior.',
        ],
    ],
    'settings' => [
        'label' => 'Manage options',
        'description' => 'Customize multi-locale behavior.',
        'static_page_locale_routing' => [
            'label' => 'Return 404 if translated page does not exist',
            'comment' => 'Enable this to return a 404 if a static page does not have a locale URL or content defined.',
        ],
    ],
];
