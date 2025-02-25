<?php

namespace App\Contracts;

interface ETLInterface
{
    public function extractData(): array;

    public function transformData(array $data) : array;

    public function loadData(array $data): void;

}