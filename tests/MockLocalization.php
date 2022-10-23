<?php declare(strict_types=1);

namespace Composite\Localization\Tests;

use Composite\Localization\AbstractLocalization;
use Composite\Localization\Language;

class MockLocalization extends AbstractLocalization
{
    public function __construct(Language $language)
    {
        parent::__construct(
            language: $language,
            sourcePath: __DIR__ . DIRECTORY_SEPARATOR . 'locales',
        );
    }

    public function cat(string $text, array $placeholders = []): string
    {
        return $this->get('test_category', $text, $placeholders);
    }

    public function absent(string $text, array $placeholders = []): string
    {
        return $this->get('absent', $text, $placeholders);
    }
}