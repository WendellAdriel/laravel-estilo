<?php

declare(strict_types=1);

use WendellAdriel\Estilo\Estilo;
use WendellAdriel\Estilo\EstiloWind;

if (! function_exists('estilo')) {
    function estilo(string $selector): string
    {
        return Estilo::use($selector);
    }
}

if (! function_exists('estilowind')) {
    function estilowind(string $name): string
    {
        return EstiloWind::use($name);
    }
}
