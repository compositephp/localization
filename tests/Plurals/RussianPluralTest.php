<?php declare(strict_types=1);

namespace Composite\Localization\Tests\Plurals;

use Composite\Localization\Plurals;

final class RussianPluralTest extends \PHPUnit\Framework\TestCase
{
    public function default_dataProvider(): array
    {
        return [
            [1, 'литр'],
            [21, 'литр'],
            [41, 'литр'],
            [101, 'литр'],
            [1001, 'литр'],
            [2, 'литра'],
            [3, 'литра'],
            [4, 'литра'],
            [22, 'литра'],
            [23, 'литра'],
            [24, 'литра'],
            [102, 'литра'],
            [103, 'литра'],
            [104, 'литра'],
            [5, 'литров'],
            [13, 'литров'],
            [19, 'литров'],
            [20, 'литров'],
            [105, 'литров'],
            [113, 'литров'],
            [119, 'литров'],
            [120, 'литров'],
            [1020, 'литров'],
            [1105, 'литров'],
            [1213, 'литров'],
            [1419, 'литров'],
            [11120, 'литров'],
            [5.5, 'литра'],
        ];
    }

    /**
     * @dataProvider default_dataProvider
     */
    public function test_getForm(int|float $number, string $expectedResult): void
    {
        $plural = new Plurals\RussianPlural('литр', 'литра', 'литров', 'литра');
        $actualResult = $plural->getForm($number);
        $this->assertEquals($expectedResult, $actualResult);
    }
}