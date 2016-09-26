# Changelog

All Notable changes to `laravel-menu` will be documented in this file

## 2.0.0
- Upgraded `spatie/menu` to 2.0
- Added a `View` item implementation to use blade views as menu items
- Link builder methods have been renamed and now have a `to` prefix: `Link::toAction`, `Link::toRoute` and `Link::toUrl`

## 1.2.0
- The `Menu` class now implements the `Illuminate\Contracts\Support\Htmlable` interface
- Fixed some dependency issues, this package now requires illuminate `5.1.14` or higher components

## 1.1.0
- Added conditional `add` functions `urlIf`, `actionIf` and `routeIf`
- Added authorized `add` function `addIfCan`, `linkIfCan`, `htmlIfCan`, `urlIfCan`, `actionIfCan` and `routeIfCan` 

## 1.0.0
- First release
