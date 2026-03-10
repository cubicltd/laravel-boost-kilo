<?php

use CubicLtd\LaravelBoostKilo\KiloCli;
use CubicLtd\LaravelBoostKilo\KiloCode;
use Laravel\Boost\Install\Detection\DetectionStrategyFactory;
use Laravel\Boost\Install\Enums\McpInstallationStrategy;
use Laravel\Boost\Install\Enums\Platform;

/*
|--------------------------------------------------------------------------
| KiloCode Test Cases
|--------------------------------------------------------------------------
*/

describe('KiloCode', function (): void {
    it('returns kilo_code as the agent name', function (): void {
        $kiloCode = new KiloCode(new DetectionStrategyFactory(app()));

        expect($kiloCode->name())->toBe('kilo_code');
    });

    it('returns Kilo Code as the display name', function (): void {
        $kiloCode = new KiloCode(new DetectionStrategyFactory(app()));

        expect($kiloCode->displayName())->toBe('Kilo Code');
    });

    it('returns correct project detection config for KiloCode', function (): void {
        $kiloCode = new KiloCode(new DetectionStrategyFactory(app()));
        $config = $kiloCode->projectDetectionConfig();

        expect($config)->toBeArray()
            ->toHaveKey('paths', ['.kilocode'])
            ->toHaveKey('files', ['AGENTS.md', '.kilocode/mcp.json']);
    });

    it('returns correct mcp config path for KiloCode', function (): void {
        $kiloCode = new KiloCode(new DetectionStrategyFactory(app()));

        expect($kiloCode->mcpConfigPath())->toBe('.kilocode/mcp.json');
    });
});

/*
|--------------------------------------------------------------------------
| KiloCli Test Cases
|--------------------------------------------------------------------------
*/

describe('KiloCli', function (): void {
    it('returns kilo_cli as the agent name', function (): void {
        $kiloCli = new KiloCli(new DetectionStrategyFactory(app()));

        expect($kiloCli->name())->toBe('kilo_cli');
    });

    it('returns Kilo CLI as the display name', function (): void {
        $kiloCli = new KiloCli(new DetectionStrategyFactory(app()));

        expect($kiloCli->displayName())->toBe('Kilo CLI');
    });

    it('returns correct project detection config for KiloCli', function (): void {
        $kiloCli = new KiloCli(new DetectionStrategyFactory(app()));
        $config = $kiloCli->projectDetectionConfig();

        expect($config)->toBeArray()
            ->toHaveKey('files', ['AGENTS.md', 'kilo.json']);
    });

    it('returns correct mcp config path for KiloCli', function (): void {
        $kiloCli = new KiloCli(new DetectionStrategyFactory(app()));

        expect($kiloCli->mcpConfigPath())->toBe('kilo.json');
    });
});

/*
|--------------------------------------------------------------------------
| KiloAgent System Detection Test Cases
|--------------------------------------------------------------------------
*/

describe('KiloAgent - System Detection', function (): void {
    it('returns correct system detection config for Darwin', function (): void {
        $kiloCode = new KiloCode(new DetectionStrategyFactory(app()));
        $config = $kiloCode->systemDetectionConfig(Platform::Darwin);

        expect($config)->toBeArray()
            ->toHaveKey('command', 'command -v kilo');
    });

    it('returns correct system detection config for Linux', function (): void {
        $kiloCode = new KiloCode(new DetectionStrategyFactory(app()));
        $config = $kiloCode->systemDetectionConfig(Platform::Linux);

        expect($config)->toBeArray()
            ->toHaveKey('command', 'command -v kilo');
    });

    it('returns correct system detection config for Windows', function (): void {
        $kiloCode = new KiloCode(new DetectionStrategyFactory(app()));
        $config = $kiloCode->systemDetectionConfig(Platform::Windows);

        expect($config)->toBeArray()
            ->toHaveKey('command', 'cmd /c where kilo 2>nul');
    });
});

/*
|--------------------------------------------------------------------------
| KiloAgent MCP Configuration Test Cases
|--------------------------------------------------------------------------
*/

describe('KiloAgent - MCP Configuration', function (): void {
    it('returns FILE as MCP installation strategy', function (): void {
        $kiloCode = new KiloCode(new DetectionStrategyFactory(app()));

        expect($kiloCode->mcpInstallationStrategy())
            ->toBe(McpInstallationStrategy::FILE);
    });

    it('returns correct mcp config key', function (): void {
        $kiloCode = new KiloCode(new DetectionStrategyFactory(app()));

        expect($kiloCode->mcpConfigKey())->toBe('mcpServers');
    });

    it('returns default MCP config with schema', function (): void {
        $kiloCode = new KiloCode(new DetectionStrategyFactory(app()));
        $config = $kiloCode->defaultMcpConfig();

        expect($config)->toBeArray()
            ->toHaveKey('$schema', 'https://app.kilo.ai/config.json');
    });

    it('returns correct HTTP MCP server config', function (): void {
        $kiloCode = new KiloCode(new DetectionStrategyFactory(app()));
        $config = $kiloCode->httpMcpServerConfig('https://example.com/mcp');

        expect($config)->toBeArray()
            ->toHaveKey('type', 'streamable-http')
            ->toHaveKey('url', 'https://example.com/mcp');
    });

    it('returns correct local MCP server config', function (): void {
        $kiloCode = new KiloCode(new DetectionStrategyFactory(app()));
        $config = $kiloCode->mcpServerConfig('kilo', ['--verbose'], ['DEBUG' => 'true']);

        expect($config)->toBeArray()
            ->toHaveKey('command', 'kilo')
            ->toHaveKey('args', ['--verbose'])
            ->toHaveKey('env', ['DEBUG' => 'true']);
    });

    it('returns correct local MCP server config without optional args', function (): void {
        $kiloCode = new KiloCode(new DetectionStrategyFactory(app()));
        $config = $kiloCode->mcpServerConfig('kilo');

        expect($config)->toBeArray()
            ->toHaveKey('command', 'kilo')
            ->toHaveKey('env', []);
    });
});

/*
|--------------------------------------------------------------------------
| KiloAgent Paths Test Cases
|--------------------------------------------------------------------------
*/

describe('KiloAgent - Paths', function (): void {
    it('returns default guidelines path when not configured', function (): void {
        $this->markTestSkipped('Requires full Laravel application context with config repository');
        $kiloCode = new KiloCode(new DetectionStrategyFactory(app()));

        expect($kiloCode->guidelinesPath())->toBe('AGENTS.md');
    });

    it('returns default skills path when not configured', function (): void {
        $this->markTestSkipped('Requires full Laravel application context with config repository');
        $kiloCode = new KiloCode(new DetectionStrategyFactory(app()));

        expect($kiloCode->skillsPath())->toBe('.agents/skills');
    });
});
