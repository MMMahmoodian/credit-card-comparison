<?php

namespace App\Services\DataProviders;

use App\Contracts\DataProviders\CreditCardDataProviderInterface;

class FinanceAdsDataProviderInterface extends BaseDataProvider implements CreditCardDataProviderInterface
{

    public function fetchCreditCardData(): array
    {
        $endpoint = 'webservice.php';
        $params = [
            'wf' => 1,
            'format' => 'xml',
            'calc' => 'kreditkarterechner',
            'country' => 'ES'
        ];

        $response = $this->fetchData($endpoint, $params);

        return $this->convertXmlToArray($response);
    }

    protected function getBaseUri(): string
    {
        return 'https://tools.financeads.net/';
    }

    private function convertXmlToArray($xmlString)
    {
        $xmlObject = simplexml_load_string($xmlString);
        $json = json_encode($xmlObject);
        return json_decode($json, true);
    }
}