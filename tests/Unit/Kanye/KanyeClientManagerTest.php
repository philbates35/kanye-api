<?php

declare(strict_types=1);

namespace Tests\Unit\Kanye;

use App\Kanye\FakeClient;
use App\Kanye\KanyeClientManager;
use App\Kanye\KanyeRestClient;
use Override;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class KanyeClientManagerTest extends TestCase
{
    private KanyeClientManager $manager;

    #[Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->manager = $this->app->make(KanyeClientManager::class);
    }

    #[Test]
    public function it_creates_kanye_rest_driver(): void
    {
        $this->assertInstanceOf(KanyeRestClient::class, $this->manager->driver('kanye_rest'));
    }

    #[Test]
    public function it_creates_fake_driver(): void
    {
        $this->assertInstanceOf(FakeClient::class, $this->manager->driver('fake'));
    }
}
