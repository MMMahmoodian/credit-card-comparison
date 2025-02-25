<?php

namespace App\Contracts\Database;

interface CreditCardRepository
{
    public function storeOrUpdate(array $data): void;
    public function storeOrUpdateBulk(array $data): void;
}