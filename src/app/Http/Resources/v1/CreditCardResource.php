<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreditCardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'logo' => $this->logo,
            'bank_name' => $this->bank->name,
            'annual_cost' => $this->TAE,
            'fee_first_year' => $this->fee_first_year,
            'fee_second_year' => $this->fee_second_year,
            'card_type' => $this->card_type->toString(),
            'special_offers' => strip_tags($this->special_offers),
            'extra_info' => strip_tags($this->extra_info),
        ];
    }
}
