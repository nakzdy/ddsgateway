<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // JWT User Provider Registration
        Auth::provider('jwt', function ($app, array $config) {
            return new \PHPOpenSourceSaver\JWTAuth\Providers\User\EloquentUserProvider(
                $app['hash'],
                $config['model']
            );
        });

        // Optional: API Token Fallback (uncomment if needed)
        /*
        $this->app['auth']->viaRequest('api', function ($request) {
            if ($token = $request->bearerToken()) {
                try {
                    return \PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth::parseToken()->authenticate();
                } catch (\Exception $e) {
                    return null;
                }
            }
            return null;
        });
        */
    }
}