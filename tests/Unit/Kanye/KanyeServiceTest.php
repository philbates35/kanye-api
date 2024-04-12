<?php

declare(strict_types=1);

namespace Tests\Unit\Kanye;

use App\Kanye\KanyeClient;
use App\Kanye\KanyeService;
use Illuminate\Contracts\Cache\Repository;
use Mockery;
use Mockery\MockInterface;
use Override;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class KanyeServiceTest extends TestCase
{
    private KanyeClient&MockInterface $client;

    private KanyeService $service;

    #[Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->client = Mockery::mock(KanyeClient::class);

        $this->service = new KanyeService($this->client, $this->app->make(Repository::class));
    }

    #[Test]
    public function it_refreshes_the_quotes_by_clearing_the_cache_then_populating(): void
    {
        $this->client->shouldReceive('getRandomQuote')
            ->times(5)
            ->andReturn('Random quote 1', 'Random quote 2', 'Random quote 3', 'Random quote 4', 'Random quote 5');

        $expected1 = [
            'Random quote 1',
            'Random quote 2',
            'Random quote 3',
            'Random quote 4',
            'Random quote 5',
        ];

        $this->assertSame($expected1, $this->service->getRandomQuotes());
        // Assert that subsequent calls don't result in the client being called again
        $this->assertSame($expected1, $this->service->getRandomQuotes());

        $this->client->shouldReceive('getRandomQuote')
            ->times(5)
            ->andReturn('Random quote 6', 'Random quote 7', 'Random quote 8', 'Random quote 9', 'Random quote 10');

        $this->service->refreshQuotes();

        $expected2 = [
            'Random quote 6',
            'Random quote 7',
            'Random quote 8',
            'Random quote 9',
            'Random quote 10',
        ];

        $this->assertSame($expected2, $this->service->getRandomQuotes());
        // Assert that subsequent calls don't result in the client being called again
        $this->assertSame($expected2, $this->service->getRandomQuotes());
    }
}
