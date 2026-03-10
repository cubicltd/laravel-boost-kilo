<?php

use CubicLtd\LaravelBoostKilo\KiloCli;
use CubicLtd\LaravelBoostKilo\KiloCode;
use CubicLtd\LaravelBoostKilo\KiloServiceProvider;
use Laravel\Boost\Boost;

/*
|--------------------------------------------------------------------------
| KiloServiceProvider Test Cases
|--------------------------------------------------------------------------
*/

describe('KiloServiceProvider', function (): void {
    it('registers both agents with Boost', function (): void {
        Boost::spy()->shouldReceive('registerAgent')->twice();

        $provider = new KiloServiceProvider(app());
        $provider->boot();

        Boost::shouldHaveReceived('registerAgent')
            ->with('kilo_code', KiloCode::class)
            ->once();
        Boost::shouldHaveReceived('registerAgent')
            ->with('kilo_cli', KiloCli::class)
            ->once();
    });
});
