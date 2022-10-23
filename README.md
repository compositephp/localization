# Composite Localization

Simple translation and pluralization php library based on files. 

Overview:
- [Localization](#localization) 
- [Pluralization](#pluralization) 

## Localization

First, you need to create new class and extend from `Composite\Localization\AbstractLocalization`

```php
use Composite\Localization\AbstractLocalization;
use Composite\Localization\Language;

class Localization extends AbstractLocalization
{
    public function __construct(Language $language)
    {
        parent::__construct(
            language: $language,
            sourcePath: '/directory/to/your/locale/files',
        );
    }

    public function general(string $text, array $placeholders = []): string
    {
        return $this->get('general', $text, $placeholders);
    }

    public function profile(string $text, array $placeholders = []): string
    {
        return $this->get('profile', $text, $placeholders);
    }
    //other categories
    //...
}
```

Usage:

```php

```

Second, create category files in your localization source path `/directory/to/your/locale/files`:

```
- general.php
- profile.php
```

Example content of `general.php`

```php
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
```

Usage:

```php
use Composite\Localization\Language;

$localization = new Localization(Language::FR);

$localization->general('Hello World!'); //Bonjour le monde!

$localization->general('hello_world'); //Bonjour le monde!

$localization->general(
    'Hello {{first_name}} {{last_name}}!', 
    ['first_name' => 'John', 'last_name' => 'Smith']
); //Bonjour John Smith!

$localization->general(
    'hello_fullname', 
    ['first_name' => 'John', 'last_name' => 'Smith']
); //Bonjour John Smith!

//if translation not exists localization instance will still output it as is

$localization->general('Bye World!'); //Bye World!

$localization->general('bye_world'); //bye_world

$localization->general(
    'Bye {{first_name}} {{last_name}}!', 
    ['first_name' => 'John', 'last_name' => 'Smith']
); //Bye John Smith!
```

## Pluralization

Create a file `_plural.php` inside folder with translation categories `/directory/to/your/locale/files`:

```php
use Composite\Localization\Language;
use Composite\Localization\Plurals\EnglishPlural;
use Composite\Localization\Plurals\FrenchPlural;

return [
    'new_comment' => [
        Language::EN->value => new EnglishPlural('new comment', 'new comments'),
        Language::FR->value => new FrenchPlural('nouveau commentaire', 'nouveaux commentaires'),
    ],
];
```

Usage:

```php
$localization->general(
    'Hello {{name}}, you have {{num}} [[new_comment:num]]', 
    ['name' => 'John', 'num' => 1]
); //Bonjour John, vous avez 1 nouveau commentaire

$localization->general(
    'Hello {{name}}, you have {{num}} [[new_comment:num]]', 
    ['name' => 'John', 'num' => 2]
); //Bonjour John, vous avez 2 nouveaux commentaires
```

## License:

MIT License (MIT). Please see [`LICENSE`](./LICENSE) for more information. Maintained by Composite PHP.