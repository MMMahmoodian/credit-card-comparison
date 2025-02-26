<?php

namespace App\Enums\CreditCard;

enum CardType: int
{
    case CREDIT = 0;
    case DEBIT = 2;

    public function toString(): string
    {
        return match ($this) {
            self::CREDIT => 'Credit',
            self::DEBIT => 'Debit',
        };
    }
}
