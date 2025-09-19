<?php

declare(strict_types=1);

use WendellAdriel\Estilo\EstiloWind;

test('it defines and forgets a style', function () {
    EstiloWind::define(
        name: 'test',
        classes: ['text-xl', 'text-amber-500'],
    );

    expect(EstiloWind::has('test'))->toBeTrue()
        ->and(EstiloWind::use('test'))->toBe('text-xl text-amber-500');

    // Forget style to not mess with other tests
    EstiloWind::forget('test');

    expect(EstiloWind::has('test'))->toBeFalse()
        ->and(EstiloWind::use('test'))->toBe('');
});
