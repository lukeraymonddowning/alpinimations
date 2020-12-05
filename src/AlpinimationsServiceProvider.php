<?php

namespace Lukeraymonddowning\Alpinimations;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AlpinimationsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->console();
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'alpinimation');

        Blade::directive('anim', fn($expression) => $this->renderAlpinimation($expression));

        Blade::directive(
            'xshow',
            function ($expression) {
                [$show, $animation] = explode(",", $expression);
                return $this->renderAlpinimation(
                    trim($animation),
                    "x-show=" . str_replace('"', "\\\"", trim($show))
                );
            }
        );
    }

    protected function console()
    {
        $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/alpinimations'),
            ],
            'alpinimations'
        );
    }

    protected function renderAlpinimation($animationName, $extra = "")
    {
        return "<?php echo \"$extra\"; echo view('alpinimation::' . $animationName)->render(); ?>";
    }
}
