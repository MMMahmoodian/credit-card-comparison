<?php

namespace App\Contracts;

interface TransformerInterface
{
    public function transform(array $data): array;
}