<?php

namespace App\Services\DataProviders;

use Illuminate\Support\Facades\Http;

abstract class BaseDataProvider
{
    abstract protected function getBaseUri(): string;

    protected function fetchData(string $endpoint, array $params = [])
    {
        $uri = $this->getBaseUri() . $endpoint;

        return Http::get($uri, $params)->getBody()->getContents();
    }
}