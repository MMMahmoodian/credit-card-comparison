<?php

namespace App\Models;

use App\Enums\BooleanEnum;
use App\Enums\CreditCard\CardType;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    protected $guarded = [];

    protected $casts = [
        'has_bonus_program' => BooleanEnum::class,
        'has_additional_insurance' => BooleanEnum::class,
        'has_discount_on_partners' => BooleanEnum::class,
        'has_additional_offers' => BooleanEnum::class,
        'card_type' => CardType::class,
    ];
}
