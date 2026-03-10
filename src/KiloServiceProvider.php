<?php

declare(strict_types=1);

namespace CubicLtd\LaravelBoostKilo;

use Illuminate\Support\ServiceProvider;
use Laravel\Boost\Boost;

class KiloServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Boost::registerAgent('kilo_code', KiloCode::class);
        Boost::registerAgent('kilo_cli', KiloCli::class);
    }
}
