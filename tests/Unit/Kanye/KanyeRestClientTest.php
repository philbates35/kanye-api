<?php

declare(strict_types=1);

namespace Tests\Unit\Kanye;

use App\Kanye\KanyeRestClient;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Override;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class KanyeRestClientTest extends TestCase
{
    private KanyeRestClient $client;

    #[Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->client = $this->app->make(KanyeRestClient::class);
    }

    #[Test]
    public function it_returns_quotes_from_the_api(): void
    {
        Http::fake([
            'https://api.kanye.rest' => Http::response(['quote' => 'A fake quote']),
        ]);

        $this->assertSame('A fake quote', $this->client->getRandomQuote());
    }

    #[Test]
    public function it_throws_exception_when_request_fails(): void
    {
        Http::fake([
            'https://api.kanye.rest' => Http::response([], 500),
        ]);

        $this->expectException(RequestException::class);
        $this->client->getRandomQuote();
    }
}
