<?php
 
namespace App\Providers;
 
use Facebook\Facebook;
use Illuminate\Support\ServiceProvider;
 
class FacebookServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
 
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Facebook::class, function ($app) {
            $config = config('services.facebook');
            return new Facebook([
                'app_id' => $config['408093733621860'],
                'app_secret' => $config['5bc75b939eb35439ae526b6356a28522'],
                'default_graph_version' => 'v2.6',
            ]);
        });
    }
}