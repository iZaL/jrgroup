<?php namespace Acme\Providers;

use Illuminate\Support\ServiceProvider;

class LangHelperServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('locale-helper', 'Acme\Services\LangHelper');
    }
}
