<?php

declare(strict_types=1);

use WendellAdriel\Estilo\Estilo;

if (! function_exists('estilowind')) {
    function estilowind(string $name): string
    {
        return Estilo::use($name);
    }
}
