<?php

namespace App\Contracts\DataProviders;

interface CreditCardDataProvider
{
    public function fetchCreditCardData(): array;
}