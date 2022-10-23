<?php declare(strict_types=1);

namespace Composite\Localization\Tests;

use Composite\Localization\Language;

final class LocalizationTest extends \PHPUnit\Framework\TestCase
{
    public function get_dataProvider(): array
    {
        return [
            [Language::EN, '', [], ''],
            [Language::EN, 'Hello World!', [], 'Hello World!'],
            [Language::FR, 'Hello World!', [], 'Bonjour le monde!'],
            [Language::EN, 'hello_world', [], 'Hello World!'],
            [Language::FR, 'hello_world', [], 'Bonjour le monde!'],
            [Language::ZH_CN, 'hello_world', [], 'hello_world'],
            [Language::EN, 'Hello {{first_name}} {{last_name}}!', ['first_name' => 'John', 'last_name' => 'Constantine'], 'Hello John Constantine!'],
            [Language::EN, 'Hello {{first_name}} {{last_name}}!', ['last_name' => 'Constantine'], 'Hello {{first_name}} Constantine!'],
            [Language::FR, 'Hello {{first_name}} {{last_name}}!', ['first_name' => 'John', 'last_name' => 'Constantine'], 'Bonjour John Constantine!'],
            [Language::FR, 'Hello {{first_name}} {{last_name}}!', ['last_name' => 'Constantine'], 'Bonjour {{first_name}} Constantine!'],
            [Language::EN, 'hello_fullname', ['first_name' => 'John', 'last_name' => 'Constantine'], 'Hello John Constantine!'],
            [Language::EN, 'hello_fullname', ['last_name' => 'Constantine'], 'Hello {{first_name}} Constantine!'],
            [Language::FR, 'hello_fullname', ['first_name' => 'John', 'last_name' => 'Constantine'], 'Bonjour John Constantine!'],
            [Language::FR, 'hello_fullname', ['last_name' => 'Constantine'], 'Bonjour {{first_name}} Constantine!'],
            [Language::FR, 'hello_fullname', ['last_name' => 'Constantine'], 'Bonjour {{first_name}} Constantine!'],
            [Language::EN, 'non existing simple', [], 'non existing simple'],
            [Language::FR, 'non existing simple', [], 'non existing simple'],
            [Language::EN, 'non existing with {{placeholder1}} {{placeholder2}}', ['placeholder2' => 'bar'], 'non existing with {{placeholder1}} bar'],
        ];
    }

    /**
     * @dataProvider get_dataProvider
     */
    public function test_get(Language $language, string $lexeme, array $placeholders, string $expectedResult): void
    {
        $localization = new MockLocalization($language);
        $actualResult = $localization->cat($lexeme, $placeholders);
        $this->assertEquals($expectedResult, $actualResult);
    }

    public function absent_category_dataProvider(): array
    {
        return [
            [Language::EN, '', [], ''],
            [Language::EN, 'Hello World!', [], 'Hello World!'],
            [Language::FR, 'Hello World!', [], 'Hello World!'],
            [Language::EN, 'hello_world', [], 'hello_world'],
            [Language::FR, 'hello_world', [], 'hello_world'],
            [Language::EN, 'Hello {{first_name}} {{last_name}}!', ['first_name' => 'John', 'last_name' => 'Constantine'], 'Hello John Constantine!'],
            [Language::EN, 'Hello {{first_name}} {{last_name}}!', ['last_name' => 'Constantine'], 'Hello {{first_name}} Constantine!'],
            [Language::FR, 'Hello {{first_name}} {{last_name}}!', ['first_name' => 'John', 'last_name' => 'Constantine'], 'Hello John Constantine!'],
            [Language::FR, 'Hello {{first_name}} {{last_name}}!', ['last_name' => 'Constantine'], 'Hello {{first_name}} Constantine!'],
        ];
    }

    /**
     * @dataProvider absent_category_dataProvider
     */
    public function test_absent_category(Language $language, string $lexeme, array $placeholders, string $expectedResult): void
    {
        $localization = new MockLocalization($language);
        $actualResult = $localization->absent($lexeme, $placeholders);
        $this->assertEquals($expectedResult, $actualResult);
    }
}