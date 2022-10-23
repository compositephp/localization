<?php declare(strict_types=1);

namespace Composite\Localization;

interface PluralInterface
{
    public function getForm(int|float $number): string;
}