<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\RefreshQuotes;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RefreshQuotesController extends Controller
{
    public function __construct(
        private readonly Dispatcher $dispatcher,
    ) {
    }

    public function __invoke(): JsonResponse
    {
        $this->dispatcher->dispatch((new RefreshQuotes()));

        return new JsonResponse(null, Response::HTTP_ACCEPTED);
    }
}
