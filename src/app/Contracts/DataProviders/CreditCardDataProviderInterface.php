<?php

namespace App\Contracts\DataProviders;

interface CreditCardDataProviderInterface
{
    public function fetchCreditCardData(): array;
}