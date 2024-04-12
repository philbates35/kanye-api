<?php

declare(strict_types=1);

namespace App\Kanye;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\RequestException;
use Override;

readonly class KanyeRestClient implements KanyeClient
{
    private const string BASE_URI = 'https://api.kanye.rest';

    public function __construct(
        private Factory $http,
    ) {
    }

    /**
     * @throws RequestException
     */
    #[Override]
    public function getRandomQuote(): string
    {
        $response = $this->http->get(self::BASE_URI);

        $response->throw();

        $quote = $response->json('quote');

        \assert(\is_string($quote));

        return $quote;
    }
}
