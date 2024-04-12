<?php

declare(strict_types=1);

namespace Tests\Unit\Kanye;

use App\Kanye\FakeClient;
use Override;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class FakeClientTest extends TestCase
{
    private FakeClient $client;

    #[Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->client = new FakeClient(['Fake quote 1', 'Fake quote 2']);
    }

    #[Test]
    public function it_picks_a_random_item_from_the_provided_quotes(): void
    {
        $this->assertContains($this->client->getRandomQuote(), ['Fake quote 1', 'Fake quote 2']);
    }
}
