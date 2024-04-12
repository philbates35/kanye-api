<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class QuotesTest extends TestCase
{
    #[Test]
    public function it_requires_authentication(): void
    {
        $this->getJson('/api/quotes')
            ->assertUnauthorized();

        $this->postJson('/api/refresh')
            ->assertUnauthorized();
    }

    #[Test]
    public function it_returns_five_random_kanye_quotes(): void
    {
        $this->authenticate();

        $response = $this->getJson('/api/quotes')
            ->assertOk();

        $quotes = $response->json('data');

        $this->assertIsArray($quotes);
        $this->assertCount(5, $quotes);

        foreach ($quotes as $quote) {
            $this->assertIsString($quote);
        }
    }

    #[Test]
    public function it_returns_the_same_five_quotes_until_refreshed_and_then_uses_the_new_quotes(): void
    {
        $this->authenticate();

        $response2 = $this->getJson('/api/quotes')
            ->assertOk();

        $quotes1 = $response2->json('data');

        $this->assertIsArray($quotes1);

        $this->assertSame($quotes1, $this->getJson('/api/quotes')->json('data'));
        $this->assertSame($quotes1, $this->getJson('/api/quotes')->json('data'));

        $this->postJson('/api/refresh')->assertAccepted();

        $response2 = $this->getJson('/api/quotes')
            ->assertOk();

        $quotes2 = $response2->json('data');

        $this->assertNotSame($quotes1, $quotes2);
        $this->assertIsArray($quotes2);
        $this->assertCount(5, $quotes2);

        $this->assertSame($quotes2, $this->getJson('/api/quotes')->json('data'));
        $this->assertSame($quotes2, $this->getJson('/api/quotes')->json('data'));
    }

    private function authenticate(): void
    {
        $user = User::factory()->make([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->be($user, 'api');
    }
}
