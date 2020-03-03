# Html Menu Generator for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-menu.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-menu)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/spatie/laravel-menu/run-tests?label=tests)
[![Quality Score](https://img.shields.io/scrutinizer/g/spatie/laravel-menu.svg?style=flat-square)](https://scrutinizer-ci.com/g/spatie/laravel-menu)
[![StyleCI](https://styleci.io/repos/52299893/shield?branch=master)](https://styleci.io/repos/52299893)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-menu.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-menu)

This is the Laravel version of [our menu package](https://github.com/spatie/menu) adds some extras like convenience methods for generating URLs and macros.

Documentation is available at https://docs.spatie.be/menu.

Upgrading from version 1? There's a [guide](https://github.com/spatie/laravel-menu#upgrading-to-20) for that!

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

## Support us

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us). 

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

``` bash
composer require spatie/laravel-menu
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

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
