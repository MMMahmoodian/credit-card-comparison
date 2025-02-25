<?php

namespace App\Services\DataProviders;

use App\Contracts\DataProviders\CreditCardDataProviderInterface;
use Illuminate\Support\Str;

class FinanceAdsDataProvider extends BaseDataProvider implements CreditCardDataProviderInterface
{

    public function fetchCreditCardData(): array
    {
        $endpoint = 'webservice.php';
        $params = [
            'wf' => 1,
            'format' => 'csv',
            'calc' => 'kreditkarterechner',
            'country' => 'ES'
        ];

        $response = $this->fetchData($endpoint, $params);
        $response = Str::replace(',', '.', $response);

        return $this->convertCsvToArray($response);
    }

    protected function getBaseUri(): string
    {
        return 'https://tools.financeads.net/';
    }

    private function convertCsvToArray(string $csvString)
    {
        $trimCsvString = trim($csvString);
        $rows = array_map(fn($item) => str_getcsv($item, ';'), explode("\n", $trimCsvString));
        $headers = array_shift($rows);

        return array_map(fn($row) => array_combine($headers, $row), $rows);
    }
}