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
            'special_offers' => strip_tags($this->decodeHtmlEntities($this->special_offers)),
            'extra_info' => strip_tags($this->decodeHtmlEntities($this->extra_info)),
        ];
    }

    /**
     * The CSV output from FinanceAds uses semicolons as separators. This means that the HTML entities are not
     * properly terminated. This is a workaround to fix this issue.
     * This method is similar implementation to the PHP function html_entity_decode() just without the termination semicolon.
     *
     * @see https://stackoverflow.com/a/23195167/10798812
     */
    private function decodeHtmlEntities(string $input): string
    {

        $mapping = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        array_walk($mapping, function(&$value) { $value = '/'.rtrim($value, ';').'(?!;)/'; });

        return preg_replace(array_values($mapping), array_keys($mapping), $input);
    }

}
