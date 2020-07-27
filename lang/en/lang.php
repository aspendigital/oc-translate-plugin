<?php return [
    'plugin' => [
        'name' => 'Multi-locale customizations',
        'description' => 'Customizations for RainLab.Translate plugin functionality',
    ],
    'translate' => [
        'change_locale' => 'Change Locale',
    ],
    'permission' => [
        'manage_translate_options' => [
            'label' => 'Manage translation options.',
            'tab' => 'Translate',
        ],
    ],
    'settings' => [
        'label' => 'Translate',
        'description' => 'Manage translation options.',
        'static_page_locale_routing' => [
            'label' => 'Return 404 if translated page does not exist',
            'comment' => 'Enable this to return a 404 if a static page does not have a locale URL defined.',
        ],
    ],
];
