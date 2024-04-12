<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Kanye\KanyeService;
use Illuminate\Contracts\Queue\ShouldQueue;

class RefreshQuotes implements ShouldQueue
{
    public function handle(KanyeService $service): void
    {
        $service->refreshQuotes();
    }
}
