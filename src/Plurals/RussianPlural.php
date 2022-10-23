<?php declare(strict_types=1);

namespace Composite\Localization\Plurals;

use Composite\Localization\PluralInterface;

class RussianPlural implements PluralInterface
{
    public function __construct(
        protected readonly string $one,
        protected readonly string $few,
        protected readonly string $many,
        protected readonly string $other,
    ) {}

    public function getForm(int|float $number): string
    {
        if ($number === 1) {
            return $this->one;
        }
        if (fmod($number, 1) !== 0.00){
            return $this->other;
        }
        $p10 = $number % 10;
        if ($p10 === 0) {
            return $this->many;
        }
        $p100 = $number % 100;
        if ($p10 === 1 && $p100 !== 11) {
            return $this->one;
        }
        if ($p10 >= 2 && $p10 <= 4 && ($p100 < 12 || $p100 > 14)) {
            return $this->few;
        }
        if ($p10 >= 5 || ($p100 >= 11 && $p100 <= 14)) {
            return $this->many;
        }
        return $this->other;
    }
}