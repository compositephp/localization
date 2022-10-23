<?php declare(strict_types=1);

namespace Composite\Localization\Tests\Plurals;

use Composite\Localization\Plurals;

final class FrenchPluralTest extends \PHPUnit\Framework\TestCase
{
    public function default_dataProvider(): array
    {
        return [
            [0, 'commentaire'],
            [1, 'commentaire'],
            [2, 'commentaires'],
            [3, 'commentaires'],
            [999, 'commentaires'],
        ];
    }

    /**
     * @dataProvider default_dataProvider
     */
    public function test_getForm(int $number, string $expectedResult): void
    {
        $plural = new Plurals\FrenchPlural('commentaire', 'commentaires');
        $actualResult = $plural->getForm($number);
        $this->assertEquals($expectedResult, $actualResult);
    }
}