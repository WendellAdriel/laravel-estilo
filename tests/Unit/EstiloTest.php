<?php

declare(strict_types=1);

use WendellAdriel\Estilo\CSS;
use WendellAdriel\Estilo\Estilo;

test('it defines and forgets a style', function () {
    Estilo::define(
        name: 'test',
        css: CSS::make()
            ->paddingTop('10px'),
    );

    expect(Estilo::styles())->toHaveCount(3)
        ->and(Estilo::style('test'))->toBeInstanceOf(CSS::class)
        ->and(Estilo::styleText('test'))->toBe('padding-top: 10px;');

    // Forget style to not mess with other tests
    Estilo::forget('test');

    expect(Estilo::styles())->toHaveCount(2)
        ->and(Estilo::style('test'))->toBeNull();
});

test('it returns tagged list', function () {
    $common = Estilo::tagged(['common']);
    $headers = Estilo::tagged(['headers']);

    expect($common)->toHaveCount(1)
        ->and($common)->toHaveKey('main-title')
        ->and($headers)->toHaveCount(2)
        ->and($headers)->toHaveKeys(['main-title', 'sub-title']);
});

test('it defines and forgets a tagged style', function () {
    Estilo::define(
        name: 'test',
        css: CSS::make()
            ->paddingTop('10px'),
        tags: ['test'],
    );

    expect(Estilo::styles())->toHaveCount(3)
        ->and(Estilo::style('test'))->toBeInstanceOf(CSS::class)
        ->and(Estilo::styleText('test'))->toBe('padding-top: 10px;');

    $test = Estilo::tagged(['test']);

    expect($test)->toHaveCount(1)
        ->and($test)->toHaveKey('test');

    // Forget style to not mess with other tests
    Estilo::forget('test');

    expect(Estilo::styles())->toHaveCount(2)
        ->and(Estilo::style('test'))->toBeNull();

    $test = Estilo::tagged(['test']);

    expect($test)->toHaveCount(0);

    $headers = Estilo::tagged(['headers']);

    expect($headers)->toHaveCount(2)
        ->and($headers)->toHaveKeys(['main-title', 'sub-title']);
});
