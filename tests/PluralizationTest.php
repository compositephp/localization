<?php declare(strict_types=1);

namespace Composite\Localization\Tests;

use Composite\Localization\Language;

final class PluralizationTest extends \PHPUnit\Framework\TestCase
{
    public function get_dataProvider(): array
    {
        return [
            [Language::EN, '', [], ''],

            [Language::EN, 'Hello {{name}}, you have {{num}} [[new_comment:num]]', [], 'Hello {{name}}, you have {{num}} new comments'],
            [Language::EN, 'Hello {{name}}, you have {{num}} [[new_comment:num]]', ['name' => 'John'], 'Hello John, you have {{num}} new comments'],
            [Language::EN, 'Hello {{name}}, you have {{num}} [[new_comment:num]]', ['name' => 'John', 'num' => 1], 'Hello John, you have 1 new comment'],
            [Language::EN, 'Hello {{name}}, you have {{num}} [[new_comment:num]]', ['name' => 'John', 'num' => 2], 'Hello John, you have 2 new comments'],
            [Language::EN, 'Hello {{name}}, you have {{num}} [[new_comment:num]]', ['num' => 999], 'Hello {{name}}, you have 999 new comments'],

            [Language::FR, 'Hello {{name}}, you have {{num}} [[new_comment:num]]', [], 'Bonjour {{name}}, vous avez {{num}} nouveau commentaire'],
            [Language::FR, 'Hello {{name}}, you have {{num}} [[new_comment:num]]', ['name' => 'John'], 'Bonjour John, vous avez {{num}} nouveau commentaire'],
            [Language::FR, 'Hello {{name}}, you have {{num}} [[new_comment:num]]', ['name' => 'John', 'num' => 1], 'Bonjour John, vous avez 1 nouveau commentaire'],
            [Language::FR, 'Hello {{name}}, you have {{num}} [[new_comment:num]]', ['name' => 'John', 'num' => 2], 'Bonjour John, vous avez 2 nouveaux commentaires'],
            [Language::FR, 'Hello {{name}}, you have {{num}} [[new_comment:num]]', ['num' => 999], 'Bonjour {{name}}, vous avez 999 nouveaux commentaires'],

            [Language::ZH_CN, 'Hello {{name}}, you have {{num}} [[new_comment:num]]', [], 'Hello {{name}}, you have {{num}} [[new_comment]]'],
            [Language::ZH_CN, 'Hello {{name}}, you have {{num}} [[new_comment:num]]', ['name' => 'John'], 'Hello John, you have {{num}} [[new_comment]]'],
            [Language::ZH_CN, 'Hello {{name}}, you have {{num}} [[new_comment:num]]', ['name' => 'John', 'num' => 1], 'Hello John, you have 1 [[new_comment]]'],
            [Language::ZH_CN, 'Hello {{name}}, you have {{num}} [[new_comment:num]]', ['name' => 'John', 'num' => 2], 'Hello John, you have 2 [[new_comment]]'],
            [Language::ZH_CN, 'Hello {{name}}, you have {{num}} [[new_comment:num]]', ['num' => 999], 'Hello {{name}}, you have 999 [[new_comment]]'],
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
}