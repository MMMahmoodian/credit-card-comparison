<?php

namespace App\Contracts;

interface TransformerInterface
{
    public function transform(array $data): array;
    public function transformBulk(array $data): array;
}