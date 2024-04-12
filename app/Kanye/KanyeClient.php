<?php

declare(strict_types=1);

namespace App\Kanye;

interface KanyeClient
{
    public function getRandomQuote(): string;
}
