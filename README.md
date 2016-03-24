# Html Menu Generator for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-menu.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-menu)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/spatie/laravel-menu/master.svg?style=flat-square)](https://travis-ci.org/spatie/laravel-menu)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/3bd62ed7-f165-470d-896e-74757b9c6023.svg?style=flat-square)](https://insight.sensiolabs.com/projects/3bd62ed7-f165-470d-896e-74757b9c6023)
[![Quality Score](https://img.shields.io/scrutinizer/g/spatie/laravel-menu.svg?style=flat-square)](https://scrutinizer-ci.com/g/spatie/laravel-menu)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-menu.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-menu)

This is the Laravel version of [our menu package](https://github.com/spatie/menu) adds some extras like convenience methods for generating URLs and macros.

Documentation is available at https://docs.spatie.be/menu.

```php
Menu::macro('main', function () {
    return Menu::new()
        ->action('HomeController@index', 'Home')
        ->action('AboutController@index', 'About')
        ->action('ContactController@index', 'Contact')
        ->setActiveFromRequest();
});
```

```html
<nav class="navigation">
    {!! Menu::main() !!}
</nav>
```

Spatie is a webdesign agency based in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

## Install

You can install the package via composer:

``` bash
$ composer require spatie/laravel-menu
```

## Usage

Documentation is available at https://docs.spatie.be/menu.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Credits

- [Sebastian De Deyne](https://github.com/sebastiandedeyne)
- [All Contributors](../../contributors)

## About Spatie

Spatie is a webdesign agency based in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
