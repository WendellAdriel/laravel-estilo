<?php

declare(strict_types=1);

use WendellAdriel\Estilo\CSS;
use WendellAdriel\Estilo\Estilo;

Estilo::define(
    selector: '.main-title',
    style: CSS::make()
        ->color('red')
        ->fontSize('20px'),
    tags: ['common', 'headers'],
);

Estilo::define(
    selector: '#hero-title',
    style: CSS::make()
        ->color('blue')
        ->fontSize('30px'),
    tags: ['headers'],
);

Estilo::define(
    selector: 'a',
    style: CSS::make()
        ->color('green')
        ->borderBottom('1px', 'dashed', 'green'),
);

return [];
