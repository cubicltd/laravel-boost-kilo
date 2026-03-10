<?php

declare(strict_types=1);

namespace CubicLtd\LaravelBoostKilo;

use Laravel\Boost\Contracts\SupportsGuidelines;
use Laravel\Boost\Contracts\SupportsMcp;
use Laravel\Boost\Contracts\SupportsSkills;
use Laravel\Boost\Install\Agents\Agent;
use Laravel\Boost\Install\Enums\McpInstallationStrategy;
use Laravel\Boost\Install\Enums\Platform;

/**
 * Abstract base agent for Kilo integrations.
 */
abstract class KiloAgent extends Agent implements SupportsGuidelines, SupportsMcp, SupportsSkills
{
    abstract protected function getConfigKey(): string;

    public function systemDetectionConfig(Platform $platform): array
    {
        return match ($platform) {
            Platform::Darwin, Platform::Linux => [
                'command' => 'command -v kilo',
            ],
            Platform::Windows => [
                'command' => 'cmd /c where kilo 2>nul',
            ],
        };
    }

    public function mcpInstallationStrategy(): McpInstallationStrategy
    {
        return McpInstallationStrategy::FILE;
    }

    public function mcpConfigKey(): string
    {
        return 'mcpServers';
    }

    public function defaultMcpConfig(): array
    {
        return [
            '$schema' => 'https://app.kilo.ai/config.json',
        ];
    }

    public function httpMcpServerConfig(string $url): array
    {
        return [
            'type' => 'streamable-http',
            'url' => $url,
        ];
    }

    public function mcpServerConfig(string $command, array $args = [], array $env = []): array
    {
        return [
            'command' => $command,
            'args' => $args,
            'env' => $env,
        ];
    }

    public function guidelinesPath(): string
    {
        return config("boost.agents.{$this->getConfigKey()}.guidelines_path", 'AGENTS.md');
    }

    public function skillsPath(): string
    {
        return config("boost.agents.{$this->getConfigKey()}.skills_path", '.agents/skills');
    }
}
