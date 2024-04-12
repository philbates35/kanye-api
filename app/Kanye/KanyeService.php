<?php

declare(strict_types=1);

namespace App\Kanye;

use Illuminate\Contracts\Cache\Repository;

class KanyeService
{
    private const int NUM_QUOTES = 5;

    private const string CACHE_KEY = 'quotes';

    public function __construct(
        private readonly KanyeClient $client,
        private readonly Repository $cache,
    ) {
    }

    /**
     * @return list<string>
     */
    public function getRandomQuotes(): array
    {
        return $this->cache->rememberForever(self::CACHE_KEY, function (): array {
            /** @var list<string> $quotes */
            $quotes = [];

            for ($i = 0; $i < self::NUM_QUOTES; ++$i) {
                $quotes[] = $this->client->getRandomQuote();
            }

            return $quotes;
        });
    }

    public function refreshQuotes(): void
    {
        $this->cache->forget(self::CACHE_KEY);

        // Warm up the cache
        $this->getRandomQuotes();
    }
}
