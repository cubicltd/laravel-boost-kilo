# Laravel Boost - Kilo Extension

[![Total Downloads](https://img.shields.io/packagist/dt/cubicltd/laravel-boost-kilo?v=1)](https://packagist.org/packages/cubicltd/laravel-boost-kilo) [![Latest Stable Version](https://img.shields.io/packagist/v/cubicltd/laravel-boost-kilo?v=1)](https://packagist.org/packages/cubicltd/laravel-boost-kilo) [![License](https://img.shields.io/packagist/l/cubicltd/laravel-boost-kilo?v=1)](https://packagist.org/packages/cubicltd/laravel-boost-kilo)

## Introduction

A Laravel package that provides [Kilo](https://kilo.ai/) integration for [Laravel Boost](https://github.com/laravel/boost).

## Requirements

- PHP 8.3 or higher
- Laravel 11.47+ / 12.53+ / 13.0+
- Laravel Boost 2.2.3 or higher

## Installation

Install the package via Composer:

```bash
composer require --dev cubicltd/laravel-boost-kilo
```

The package will auto-register via the service provider.

## Usage

After installation, the package automatically registers two agents with Laravel Boost:

- **Kilo Code** (`kilo_code`) - IDE integration for Kilo
- **Kilo CLI** (`kilo_cli`) - CLI integration for Kilo

To install or update the Kilo agent configuration, run:

```bash
php artisan boost:install
```

## Configuration

Each agent supports custom paths for guidelines and skills. You can configure it in your `config/boost.php`:

```php
return [
    'agents' => [
        'kilo_code' => [
            'guidelines_path' => 'AGENTS.md',
            'skills_path' => '.agents/skills',
        ],
        'kilo_cli' => [
            'guidelines_path' => 'AGENTS.md',
            'skills_path' => '.agents/skills',
        ],
    ],
];
```

## License

Laravel Boost - Kilo Extension is open-sourced software licensed under the [MIT license](LICENSE.md).
