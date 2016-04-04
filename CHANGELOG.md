# Changelog

All Notable changes to `laravel-menu` will be documented in this file

## 1.2.0
- The `Menu` class now implements the `Illuminate\Contracts\Support\Htmlable` interface
- Fixed some dependency issues, this package now requires illuminate 5.1.14+ components

## 1.1.0
- Added conditional `add` functions `urlIf`, `actionIf` and `routeIf`
- Added authorized `add` function `addIfCan`, `linkIfCan`, `htmlIfCan`, `urlIfCan`, `actionIfCan` and `routeIfCan` 

## 1.0.0
- First release
