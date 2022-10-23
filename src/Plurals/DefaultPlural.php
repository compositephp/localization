<?php declare(strict_types=1);

namespace Composite\Localization\Plurals;

use Composite\Localization\PluralInterface;

class DefaultPlural implements PluralInterface
{
    public function __construct(
        protected readonly string $one,
        protected readonly string $other,
    ) {}

    public function getForm(int|float $number): string
    {
        if ($number === 1) {
            return $this->one;
        }
        return $this->other;
    }
}