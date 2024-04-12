<?php

declare(strict_types=1);

namespace App\Kanye;

use Override;

readonly class FakeClient implements KanyeClient
{
    /**
     * @param list<string> $quotes
     */
    public function __construct(
        private array $quotes,
    ) {
    }

    #[Override]
    public function getRandomQuote(): string
    {
        return $this->quotes[\array_rand($this->quotes)];
    }
}
