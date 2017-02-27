<?php

namespace Foostart\Sample;

use Illuminate\Support\ServiceProvider;

class SampleServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
         $this->loadViewsFrom(__DIR__.'/views', 'sample');
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        include __DIR__ . '/routes.php';
        $this->app->make('Foostart\Sample\SampleController');
    }

}
