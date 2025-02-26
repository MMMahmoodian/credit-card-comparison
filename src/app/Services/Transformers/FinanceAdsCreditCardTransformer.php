<?php

namespace App\Services\Transformers;

use App\Contracts\Transformers\CreditCardTransformerInterface;
use App\Enums\BooleanEnum;
use App\Enums\CreditCard\CardType;

class FinanceAdsCreditCardTransformer implements CreditCardTransformerInterface
{
    public function transformBulk(array $data): array
    {
        $transformed = [];
        foreach ($data as $item) {
            $transformed[] = $this->transform($item);
        }

        return $transformed;
    }

    public function transform(array $data): array
    {
        return [
            'id'                                => $data['productid'],
            'title'                             => $data['produkt'],
            'link'                              => $data['link'],
            'logo'                              => $data['logo'],
            'bank_id'                           => $data['bankid'],
            'bank_name'                         => $data['bank'],
            'extra_info'                        => mb_convert_encoding($data['anmerkungen'], 'UTF-8'),

            'rating'                            => $this->convertStringToFloat($data['bewertung']),
            'TAE'                               => $this->convertStringToFloat($data['incentive']),
            'annual_charges'                    => $this->convertStringToFloat($data['gebuehren']),
            'annual_transaction_costs'          => $this->convertStringToFloat($data['kosten']),

            'has_bonus_program'                 => BooleanEnum::from($data['bonusprogram']),
            'has_additional_insurance'          => BooleanEnum::from($data['insurances']),
            'has_discount_on_partners'          => BooleanEnum::from($data['benefits']),
            'has_additional_offers'             => BooleanEnum::from($data['services']),

            'special_offers'                    => mb_convert_encoding($data['besonderheiten'], 'UTF-8'),
            'participation_fee'                 => $this->convertStringToFloat($this->removeNonNumberCharacters($data['gebuehrenmitaktion'])),
            'participation_cost'                => $this->convertStringToFloat($this->removeNonNumberCharacters($data['kostenmitaktion'])),

            'fee_first_year'                    => $this->convertStringToFloat($data['gebuehrenjahr1']),
            'fee_second_year'                   => $this->convertStringToFloat($data['dauerhaft']),
            'fee_atm_national'                  => $this->convertStringToFloat($data['gc_atmfree_domestic']),
            'fee_atm_international'             => $this->convertStringToFloat($data['gc_atmfree_international']),

            'free_atm_national_fee_amount'      => $this->convertStringToFloat($data['cc_atmfree_domestic']),
            'free_atm_eu_fee_amount'            => $this->convertStringToFloat($data['cc_atmfree_euro']),
            'free_atm_international_fee_amount' => $this->convertStringToFloat($data['cc_atmfree_international']),

            'saving_interest_rate'              => $this->convertStringToFloat($data['habenzins']),
            'debt_interest_rate'                => $this->convertStringToFloat($data['sollzins']),
            'card_type'                         => CardType::from($data['cardtype']),
        ];
    }

    private function removeNonNumberCharacters(string $input): array|string|null
    {
        return preg_replace('/[^0-9.]/', '', $input);
    }

    private function convertStringToFloat(string $input): float
    {
        return floatval($input);
    }

    private function convertStringToInt(string $input): int
    {
        return intval($input);
    }
}