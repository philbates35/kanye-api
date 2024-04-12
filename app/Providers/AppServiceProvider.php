<?php

declare(strict_types=1);

namespace App\Providers;

use App\Kanye\KanyeClient;
use App\Kanye\KanyeClientManager;
use Carbon\CarbonImmutable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\ServiceProvider;
use Override;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    #[Override]
    public function register(): void
    {
        $this->app->bind(KanyeClient::class, static function (Application $app): KanyeClient {
            $driver = $app->make(KanyeClientManager::class)->driver();

            \assert($driver instanceof KanyeClient);

            return $driver;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Date::useClass(CarbonImmutable::class);

        if ($this->isProduction()) {
            Model::shouldBeStrict();
        }
    }

    private function isProduction(): bool
    {
        $environment = $this->app->environment('production');

        \assert(\is_bool($environment));

        return $environment;
    }
}
