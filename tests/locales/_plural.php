<?php

use Composite\Localization\Language;
use Composite\Localization\Plurals\EnglishPlural;
use Composite\Localization\Plurals\FrenchPlural;

return [
    'new_comment' => [
        Language::EN->value => new EnglishPlural('new comment', 'new comments'),
        Language::FR->value => new FrenchPlural('nouveau commentaire', 'nouveaux commentaires'),
    ],
];