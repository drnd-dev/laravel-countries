# Changelog

All notable changes to `laravel-countries` will be documented in this file

## 5.1.1
### Fixed
- Tests failing due CountryRegionFactory random length (#5).

## 5.1.0
### Added
- Language format configuration (#2).

### Fixed
- Database migration publishing (#3).

## 5.0.0

### Added
- Latvian language translations for all countries.
- GitHub Actions CI workflows for automated testing and static analysis.
- PHPStan / Larastan static analysis.
- Laravel Pint for code style enforcement.
- Docker setup for local development when contributing to the package.
- Support for Laravel 13.

### Fixed
- Various PHPStan errors: missing generics, argument and return types.

### Updated
- Code style normalized across the entire codebase with Laravel Pint.

### Removed
- Laravel 10 and Laravel 11 support.
- `doctrine/dbal` and `laravel/legacy-factories` dev dependencies.
- `AsFlagEmoji` cast class.
