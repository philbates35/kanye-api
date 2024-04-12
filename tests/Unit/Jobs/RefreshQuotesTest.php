<?php

declare(strict_types=1);

namespace Tests\Unit\Jobs;

use App\Jobs\RefreshQuotes;
use App\Kanye\KanyeService;
use Mockery;
use Mockery\MockInterface;
use Override;
use PHPUnit\Framework\Attributes\DoesNotPerformAssertions;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class RefreshQuotesTest extends TestCase
{
    private KanyeService&MockInterface $service;

    #[Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->service = Mockery::mock(KanyeService::class);
    }

    #[Test]
    #[DoesNotPerformAssertions]
    public function it_defers_to_the_service(): void
    {
        $this->service->shouldReceive('refreshQuotes')->once();

        $job = new RefreshQuotes();

        $job->handle($this->service);
    }
}
