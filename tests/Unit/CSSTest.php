<?php

declare(strict_types=1);

use WendellAdriel\Estilo\CSS;

test('it generates single CSS property correctly', function () {
    $class = new CSS();

    $class->color('black');

    $this->assertSame('color: black;', $class->style());
});

test('it generates multiple CSS properties correctly', function () {
    $class = new CSS();

    $class->color('red')
        ->margin('10px', '15px');

    $this->assertSame('color: red; margin: 10px 15px;', $class->style());
});
