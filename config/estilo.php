<?php

declare(strict_types=1);

use WendellAdriel\Estilo\CSS;
use WendellAdriel\Estilo\Estilo;
use WendellAdriel\Estilo\EstiloWind;

Estilo::define(
    selector: 'body',
    css: CSS::make()
        ->padding('10px'),
    tags: ['base'],
);

Estilo::define(
    selector: '.main-title',
    css: CSS::make()
        ->color('red')
        ->fontSize('20px'),
    tags: ['common', 'headers'],
);

Estilo::define(
    selector: '#hero-title',
    css: CSS::make()
        ->color('blue')
        ->fontSize('30px'),
    tags: ['headers'],
);

Estilo::define(
    selector: 'a',
    css: CSS::make()
        ->color('green')
        ->borderBottom('1px', 'dashed', 'green'),
);

EstiloWind::define(
    name: 'feat-text',
    classes: ['text-xl', 'text-amber-500', 'font-bold'],
);

return [];
