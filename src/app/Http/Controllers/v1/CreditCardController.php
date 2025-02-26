<?php

namespace App\Http\Controllers\v1;

use App\Contracts\Database\CreditCardRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\CreditCard\IndexRequest;
use App\Http\Resources\v1\CreditCardResource;

class CreditCardController extends Controller
{
    public function __construct(private CreditCardRepositoryInterface $creditCardRepository)
    {
    }

    public function index(IndexRequest $request)
    {
        $validated = $request->validated();
        $results = $this->creditCardRepository->index($validated);
        return response()->json([
            'data' => CreditCardResource::collection($results),
            'errors' => []
        ]);
    }
}
