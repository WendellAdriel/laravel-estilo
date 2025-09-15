<?php

declare(strict_types=1);

use WendellAdriel\Estilo\CSS;
use WendellAdriel\Estilo\Estilo;

Estilo::define(
    selector: 'main-title',
    css: CSS::make()
        ->color('red')
        ->fontSize('20px'),
    tags: ['common', 'headers'],
);

Estilo::define(
    selector: 'sub-title',
    css: CSS::make()
        ->color('blue')
        ->fontSize('15px'),
    tags: ['headers'],
);

return [];
