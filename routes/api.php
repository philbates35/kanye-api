<?php

declare(strict_types=1);

use App\Http\Controllers\ListQuotesController;
use App\Http\Controllers\RefreshQuotesController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')
    ->group(static function (): void {
        Route::get('/quotes', ListQuotesController::class);
        Route::post('/refresh', RefreshQuotesController::class);
    });
