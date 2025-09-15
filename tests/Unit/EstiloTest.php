<?php

declare(strict_types=1);

use WendellAdriel\Estilo\CSS;
use WendellAdriel\Estilo\Estilo;

test('it defines and forgets a style', function () {
    Estilo::define(
        selector: '.test',
        css: CSS::make()
            ->paddingTop('10px'),
    );

    expect(Estilo::styles())->toHaveCount(4)
        ->and(Estilo::style('.test'))->toBeInstanceOf(CSS::class)
        ->and(Estilo::styleText('.test'))->toBe('padding-top: 10px;');

    // Forget style to not mess with other tests
    Estilo::forget('.test');

    expect(Estilo::styles())->toHaveCount(3)
        ->and(Estilo::style('.test'))->toBeNull();
});

test('it returns tagged list', function () {
    $common = Estilo::tagged(['common']);
    $headers = Estilo::tagged(['headers']);

    expect($common)->toHaveCount(1)
        ->and($common)->toContain('.main-title')
        ->and($headers)->toHaveCount(2)
        ->and($headers)->toContain('.main-title', '#hero-title');
});

test('it defines and forgets a tagged style', function () {
    Estilo::define(
        selector: '.test',
        css: CSS::make()
            ->paddingTop('10px'),
        tags: ['test'],
    );

    expect(Estilo::styles())->toHaveCount(4)
        ->and(Estilo::style('.test'))->toBeInstanceOf(CSS::class)
        ->and(Estilo::styleText('.test'))->toBe('padding-top: 10px;');

    $test = Estilo::tagged(['test']);

    expect($test)->toHaveCount(1)
        ->and($test)->toContain('.test');

    // Forget style to not mess with other tests
    Estilo::forget('.test');

    expect(Estilo::styles())->toHaveCount(3)
        ->and(Estilo::style('.test'))->toBeNull();

    $test = Estilo::tagged(['test']);

    expect($test)->toHaveCount(0);

    $headers = Estilo::tagged(['headers']);

    expect($headers)->toHaveCount(2)
        ->and($headers)->toContain('.main-title', '#hero-title');
});

test('it renders full style sheet', function () {
    expect(Estilo::styleSheet())
        ->toBe("<style>\n\t.main-title { color: red; font-size: 20px; }\n\t#hero-title { color: blue; font-size: 30px; }\n\ta { color: green; border-bottom: 1px dashed green; }\n</style>");
});

test('it renders style sheet for tags', function () {
    expect(Estilo::styleSheet(['common']))
        ->toBe("<style>\n\t.main-title { color: red; font-size: 20px; }\n</style>");
});
