<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Kanye\KanyeService;
use Illuminate\Http\JsonResponse;

class ListQuotesController extends Controller
{
    public function __construct(
        private readonly KanyeService $service,
    ) {
    }

    public function __invoke(): JsonResponse
    {
        $quotes = $this->service->getRandomQuotes();

        return new JsonResponse(['data' => $quotes]);
    }
}
