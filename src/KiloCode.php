<?php

declare(strict_types=1);

namespace CubicLtd\LaravelBoostKilo;

class KiloCode extends KiloAgent
{
    public function name(): string
    {
        return 'kilo_code';
    }

    public function displayName(): string
    {
        return 'Kilo Code';
    }

    public function projectDetectionConfig(): array
    {
        return [
            'paths' => ['.kilocode'],
            'files' => ['AGENTS.md', '.kilocode/mcp.json'],
        ];
    }

    public function mcpConfigPath(): string
    {
        return '.kilocode/mcp.json';
    }

    protected function getConfigKey(): string
    {
        return 'kilo_code';
    }
}
