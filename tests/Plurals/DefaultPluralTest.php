<?php declare(strict_types=1);

namespace Composite\Localization\Tests\Plurals;

use Composite\Localization\Plurals;

final class DefaultPluralTest extends \PHPUnit\Framework\TestCase
{
    public function default_dataProvider(): array
    {
        return [
            [0, 'comments'],
            [1, 'comment'],
            [2, 'comments'],
            [3, 'comments'],
            [999, 'comments'],
        ];
    }

    /**
     * @dataProvider default_dataProvider
     */
    public function test_getForm(int $number, string $expectedResult): void
    {
        $plural = new Plurals\DefaultPlural('comment', 'comments');
        $actualResult = $plural->getForm($number);
        $this->assertEquals($expectedResult, $actualResult);
    }
}