<?php

declare(strict_types=1);

namespace WendellAdriel\Estilo\Providers;

use Illuminate\Support\Facades\Blade;
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

        Blade::directive('estilo', function ($expression) {
            $expression = $expression ?: '[]';

            return "<?php echo \\WendellAdriel\\Estilo\\Estilo::styleSheet({$expression}); ?>";
        });
    }

    /**
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/estilo.php', 'estilo');
    }
}
