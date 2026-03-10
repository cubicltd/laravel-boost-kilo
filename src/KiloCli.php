<?php

declare(strict_types=1);

namespace CubicLtd\LaravelBoostKilo;

class KiloCli extends KiloAgent
{
    public function name(): string
    {
        return 'kilo_cli';
    }

    public function displayName(): string
    {
        return 'Kilo CLI';
    }

    public function projectDetectionConfig(): array
    {
        return [
            'files' => ['AGENTS.md', 'kilo.json'],
        ];
    }

    public function mcpConfigPath(): string
    {
        return 'kilo.json';
    }

    protected function getConfigKey(): string
    {
        return 'kilo_cli';
    }
}
