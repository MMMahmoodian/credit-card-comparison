<?php

namespace App\Contracts\Database;

interface CreditCardRepositoryInterface
{
    public function storeOrUpdate(array $data): void;
    public function storeOrUpdateBulk(array $data): void;

    public function index(array $inputs);
}