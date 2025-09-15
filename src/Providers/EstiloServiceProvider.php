<?php

declare(strict_types=1);

namespace WendellAdriel\Estilo\Providers;

use Illuminate\Support\ServiceProvider;

final class EstiloServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        $this->publishes(
            [
                __DIR__ . '/../../config/estilo.php' => base_path('config/estilo.php'),
            ],
            'config'
        );
    }

    /**
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/estilo.php', 'estilo');
    }
}
