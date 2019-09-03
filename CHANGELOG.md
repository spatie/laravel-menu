# Changelog

All Notable changes to `laravel-menu` will be documented in this file

## 3.4.0 - 2019-09-03
- Added: Laravel 6.0 compatibility

## 3.3.1 - 2019-02-27
- Added: Laravel 5.8 compatibility
- Removed: PHP 7.0 support

## 3.2.1 - 2018-09-10
- Fixed: `actionIf` & `actionIfCan` signatures for Laravel 5.7 callable action syntax

## 3.2.0 - 2018-09-04
- Added: Support for Laravel 5.7 callable action syntax

## 3.1.1 - 2018-09-04
- Added: Laravel 5.7 compatibility

## 3.1.0 - 2018-02-08
- Added: Laravel 5.6 compatibility

## 3.0.0 - 2017-08-30
- Added: Laravel 5.5 compatibility
- Removed: Dropped support for older Laravel versions
- Changed: Moved facade to `Spatie\Menu\Laravel\Facades\Menu`

## 2.1.5 - 2017-08-28
- Fixed: Code signature fixes

## 2.1.4 - 2017-08-04
- Changed: Bumped the menu package version requirement

## 2.1.3 - 2017-08-04
- Fixed: Regression caused by an old `use` statement

## 2.1.2 - 2017-02-20
- Removed: Unused fifth `$route` parameter in `route`

## 2.1.1 - 2017-01-23
- Removed: Dropped support for Laravel 5.1

## 2.1.0 - 2017-01-23
- Added: Support for Laravel 5.4

## 2.0.3 - 2016-12-03
- Added: Default `$data` argument to `Menu::viewIf` and `Menu::viewIfCan`

## 2.0.2 - 2016-10-26
- Fixed: other url helpers so they can take the same type of parameters as the Laravel's counterparts

## 2.0.1 - 2016-10-25
- Fixed: `Link`'s action helper so it can take the same type of parameters as the Laravel's `action` helper

## 2.0.0
- Changed: Upgraded `spatie/menu` to 2.0.
- Added: Added a `View` item implementation to use blade views as menu items.
- Changed: Link builder methods have been renamed and now have a `to` prefix: `Link::toAction`, `Link::toRoute` and `Link::toUrl`.

## 1.2.0
- Added: The `Menu` class now implements the `Illuminate\Contracts\Support\Htmlable` interface
- Fixed: Some dependency issues, this package now requires illuminate `5.1.14` or higher components

## 1.1.0
- Added: Conditional `add` functions `urlIf`, `actionIf` and `routeIf`
- Added: Authorized `add` function `addIfCan`, `linkIfCan`, `htmlIfCan`, `urlIfCan`, `actionIfCan` and `routeIfCan`

## 1.0.0
- Initial release
