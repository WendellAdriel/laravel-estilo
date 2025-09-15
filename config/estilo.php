<?php

declare(strict_types=1);

use WendellAdriel\Estilo\CSS;
use WendellAdriel\Estilo\Estilo;

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

return [];
