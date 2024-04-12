<?php

declare(strict_types=1);

namespace App\Kanye;

use Illuminate\Support\Manager;
use Override;

class KanyeClientManager extends Manager
{
    #[Override]
    public function getDefaultDriver(): string
    {
        $driver = $this->config->get('kanye.driver');

        \assert(\is_string($driver));

        return $driver;
    }

    public function createKanyeRestDriver(): KanyeClient
    {
        return $this->container->make(KanyeRestClient::class);
    }

    public function createFakeDriver(): KanyeClient
    {
        $quotesJson = $this->container->make('files')->get(\resource_path('fixtures/quotes.json'));

        /** @var list<string> $quotes */
        $quotes = \json_decode($quotesJson, true);

        return new FakeClient($quotes);
    }
}
