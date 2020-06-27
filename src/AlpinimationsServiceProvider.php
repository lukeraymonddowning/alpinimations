<?php

namespace Lukeraymonddowning\Alpinimations;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AlpinimationsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'alpinimation');

        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    __DIR__ . '/../resources/views' => resource_path('views/vendor/alpinimations'),
                ],
                'views'
            );
        }

        Blade::directive(
            'anim',
            function ($expression) {
                return $this->renderAlpinimation($expression);
            }
        );

        Blade::directive(
            'xshow',
            function ($expression) {
                $parts = explode(",", $expression);
                return $this->renderAlpinimation(trim($parts[1]), "x-show=" . str_replace('"', "\\\"", trim($parts[0])));
            }
        );
    }

    protected function renderAlpinimation($animationName, $extra = "")
    {
        return "<?php echo \"$extra\"; echo view('alpinimation::' . $animationName)->render(); ?>";
    }
}
