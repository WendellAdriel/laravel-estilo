<?php

declare(strict_types=1);

use WendellAdriel\Estilo\CSS;
use WendellAdriel\Estilo\Estilo;

Estilo::define(
    name: 'main-title',
    css: CSS::make()
        ->color('red')
        ->fontSize('20px')
);

Estilo::define(
    name: 'sub-title',
    css: CSS::make()
        ->color('blue')
        ->fontSize('15px')
);

return [];
