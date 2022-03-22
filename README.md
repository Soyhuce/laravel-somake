# An opinionated package to generate classes in your Laravel project

[![Latest Version on Packagist](https://img.shields.io/packagist/v/soyhuce/laravel-somake.svg?style=flat-square)](https://packagist.org/packages/soyhuce/laravel-somake)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/soyhuce/laravel-somake/run-tests?label=tests)](https://github.com/soyhuce/laravel-somake/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/soyhuce/laravel-somake/Check%20&%20fix%20styling?label=code%20style)](https://github.com/soyhuce/laravel-somake/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![GitHub PHPStan Action Status](https://img.shields.io/github/workflow/status/soyhuce/laravel-somake/PHPStan?label=phpstan)](https://github.com/soyhuce/laravel-somake/actions?query=workflow%3APHPStan+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/soyhuce/laravel-somake.svg?style=flat-square)](https://packagist.org/packages/soyhuce/laravel-somake)

A set of commands to easily generate classes on the right place.

## Installation

You can install the package via composer:

```bash
composer require --dev soyhuce/laravel-somake
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="somake-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="somake-views"
```

## Usage

The commands of this package do not offer options, or the options are designed to be used internally only.

The configuration of generated classes is done via interactive questions.

### App

| Commande            | Description | Generation path                                  |
|---------------------|-------------|--------------------------------------------------|
| `somake:command`    | Commande    | `app/App/Commands`                               |
| `somake:controller` | Controller  | `app/App/[application]/Controllers/[namespace?]` |
| `somake:middleware` | Middleware  | `app/App/[application]/Middlewares/[namespace?]` |
| `somake:request`    | Request     | `app/App/[application]/Requests/[namespace?]`    |
| `somake:resource`   | Resource    | `app/App/[application]/Resources/[model domain]` |

### Domain

| Commande         | Description          | Generation path                |
|------------------|----------------------|--------------------------------|
| `somake:action`  | Action               | `app/Domain/[domain]/Actions`  |
| `somake:builder` | Eloquent Builder     | `app/Domain/[domain]/Builders` |
| `somake:dto`     | Data Transfer Object | `app/Domain/[domain]/DTO`      |
| `somake:enum`    | Enum                 | `app/Domain/[domain]/Enums`    |
| `somake:model`   | Model                | `app/Domain/[domain]/Models`   |
| `somake:policy`  | Policy               | `app/Domain/[domain]/Policies` |

### Support

| Commande            | Description      | Generation path                             |
|---------------------|------------------|---------------------------------------------|
| `somake:enum`       | Enum             | `app/Support/Enums`                         |
| `somake:middleware` | Middleware       | `app/Support/Http/Middlewares/[namespace?]` |
| `somake:provider`   | Service Provider | `app/Support/Providers`                     |

### Other

| Commande           | Description     | Generation path                             |
|--------------------|-----------------|---------------------------------------------|
| `somake:factory`   | Model factory   | `database/factories/[modelDomain]`          |
| `somake:migration` | Migration       | `database/migrations/[migration]`           |
| `somake:test`      | Test - contract | `tests/Contract/[application]/[controller]` |
| `somake:test`      | Test - feature  | `tests/Feature/[application]/[controller]`  |
| `somake:test`      | Test - unit     | `tests/Unit/[classDomain]`                  |

### Open created files in your IDE

To open created files in your IDE, you can just need to define the `somake.ide_path` config with the binary path of your IDE.

You can also define the `IDE` environment variable (in your `.env` file for exemple).

```bash
IDE=/usr/bin/phpstorm
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Bastien Philippe](https://github.com/bastien-phi)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
