<?php

declare(strict_types=1);

use WendellAdriel\Estilo\CSS;
use WendellAdriel\Estilo\Estilo;

test('it defines and forgets a style', function () {
    Estilo::define(
        selector: '.test',
        style: CSS::make()
            ->paddingTop('10px'),
    );

    expect(Estilo::has('.test'))->toBeTrue()
        ->and(Estilo::use('.test'))->toBe('padding-top: 10px;');

    // Forget style to not mess with other tests
    Estilo::forget('.test');

    expect(Estilo::has('.test'))->toBeFalse()
        ->and(Estilo::use('.test'))->toBe('');
});

test('it renders full style sheet', function () {
    expect(Estilo::styleSheet())
        ->toBe("<style>\n\t.main-title { color: red; font-size: 20px; }\n\t#hero-title { color: blue; font-size: 30px; }\n\ta { color: green; border-bottom: 1px dashed green; }\n</style>");
});

test('it renders style sheet for tags', function () {
    expect(Estilo::styleSheet(['common']))
        ->toBe("<style>\n\t.main-title { color: red; font-size: 20px; }\n</style>");
});
