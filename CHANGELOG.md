# Changelog

All Notable changes to `laravel-menu` will be documented in this file

## 2.1.4 - 2017-08-04
- Bumped the menu package version requirement

## 2.1.3 - 2017-08-04
- Fixed a regression caused by an old `use` statement

## 2.1.2 - 2017-02-20
- Removed the unused fifth `$route` parameter in `route`

## 2.1.1 - 2017-01-23
- Dropped support for Laravel 5.1

## 2.1.0 - 2017-01-23
- Added support for Laravel 5.4

## 2.0.3 - 2016-12-03
- Added a default `$data` argument to `Menu::viewIf` and `Menu::viewIfCan`

## 2.0.2 - 2016-10-26
- Fixed other url helpers so they can take the same type of parameters as the Laravel's counterparts

## 2.0.1 - 2016-10-25
- Fix `Link`'s action helper so it can take the same type of parameters as the Laravel's `action` helper

## 2.0.0
- Upgraded `spatie/menu` to 2.0.
- Added: Added a `View` item implementation to use blade views as menu items.
- Changed: Link builder methods have been renamed and now have a `to` prefix: `Link::toAction`, `Link::toRoute` and `Link::toUrl`.

## 1.2.0
- The `Menu` class now implements the `Illuminate\Contracts\Support\Htmlable` interface
- Fixed some dependency issues, this package now requires illuminate `5.1.14` or higher components

## 1.1.0
- Added conditional `add` functions `urlIf`, `actionIf` and `routeIf`
- Added authorized `add` function `addIfCan`, `linkIfCan`, `htmlIfCan`, `urlIfCan`, `actionIfCan` and `routeIfCan`

## 1.0.0
- First release
