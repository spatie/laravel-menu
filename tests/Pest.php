<?php

use Spatie\Menu\Item;
use Spatie\Menu\Laravel\Test\TestCase;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
*/

uses(TestCase::class)->in('.');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
*/

function assertRenders(string $expected, Item $item, string $message = ''): void
{
    expect(sanitizeHtmlWhitespace($item->render()))->toEqual(sanitizeHtmlWhitespace($expected));
}

function sanitizeHtmlWhitespace(string $subject): string
{
    $find = ['/>\s+</', '/(^\s+)|(\s+$)/', "/\r\n?/"];
    $replace = ['><', '', "\n"];

    return preg_replace($find, $replace, $subject);
}
