<?php

use Composite\Localization\Language;

return [
    'Hello World!' => [
        Language::FR->value => 'Bonjour le monde!'
    ],
    'hello_world' => [
        Language::EN->value => 'Hello World!',
        Language::FR->value => 'Bonjour le monde!',
    ],
    'Hello {{first_name}} {{last_name}}!' => [
        Language::FR->value => 'Bonjour {{first_name}} {{last_name}}!',
    ],
    'hello_fullname' => [
        Language::EN->value => 'Hello {{first_name}} {{last_name}}!',
        Language::FR->value => 'Bonjour {{first_name}} {{last_name}}!',
    ],
    'Hello {{name}}, you have {{num}} [[new_comment:num]]' => [
        Language::FR->value => 'Bonjour {{name}}, vous avez {{num}} [[new_comment:num]]',
    ],
];