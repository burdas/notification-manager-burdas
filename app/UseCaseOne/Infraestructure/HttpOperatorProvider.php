<?php

namespace App\UseCaseOne\Infraestructure;
use App\UseCaseOne\Domain\OperatorProvider;
use Illuminate\Support\Facades\Http;

class HttpOperatorProvider implements OperatorProvider
{
    private const OPERATORS_URL = 'https://api.external.com/operators/?sequence_number=12341234';
    public function getOperators(): array
    {
        $response = Http::get(self::OPERATORS_URL);

        if ($response->failed()) {
            return [$response->getStatusCode(), []];
        }

        return [$response->getStatusCode(), $response->json()];
    }
}
