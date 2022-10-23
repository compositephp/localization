<?php declare(strict_types=1);

namespace Composite\Localization\Plurals;

class FrenchPlural extends DefaultPlural
{
    public function getForm(int|float $number): string
    {
        if ($number === 0 || $number === 1) {
            return $this->one;
        }
        return $this->other;
    }
}