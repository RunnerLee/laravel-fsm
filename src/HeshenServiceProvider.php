<?php
/**
 * @author: RunnerLee
 * @email: runnerleer@gmail.com
 * @time: 2018-07
 */

namespace Runner\LaravelFsm;

use Illuminate\Support\ServiceProvider;
use Runner\Heshen\Factory;

class HeshenServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/fsm.php' => config_path('fsm.php'),
        ]);
    }

    public function register()
    {
        $this->app->singleton('heshen.factory', function () {
            return new Factory(config('fsm.blueprints'));
        });
        $this->app->alias('heshen.factory', Factory::class);
    }
}
