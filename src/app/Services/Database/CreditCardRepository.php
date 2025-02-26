<?php

namespace App\Services\Database;

use App\Contracts\Database\CreditCardRepositoryInterface;
use App\Enums\BooleanEnum;
use App\Models\Bank;
use App\Models\CreditCard;

class CreditCardRepository implements CreditCardRepositoryInterface
{

    public function storeOrUpdate(array $data): void
    {
        $bank = Bank::query()->firstOrCreate(['id' => $data['bank_id']], ['name' => $data['bank_name']]);
        unset($data['bank_name']);
//        dd($data);
        CreditCard::query()->updateOrCreate([
            'id' => $data['id'],
        ], $data);
    }

    public function storeOrUpdateBulk(array $data): void
    {
        foreach ($data as $item) {
            $this->storeOrUpdate($item);
        }
    }
}