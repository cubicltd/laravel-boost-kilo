<?php

namespace Tests;

use CubicLtd\LaravelBoostKilo\KiloServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function getPackageProviders($app): array
    {
        return [
            KiloServiceProvider::class,
        ];
    }
}
