<?php

require_once __DIR__.'/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));

$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

$app->withFacades();
$app->withEloquent();

// Register configurations
$app->configure('app');
$app->configure('auth');
$app->configure('jwt'); // Add this for JWT configuration

// Exception/Console bindings
$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);
$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

// Middleware
$app->routeMiddleware([
    'auth' => App\Http\Middleware\Authenticate::class,
    // Remove Passport middleware and add JWT if needed
    'jwt.auth' => PHPOpenSourceSaver\JWTAuth\Http\Middleware\Authenticate::class,
    'jwt.refresh' => PHPOpenSourceSaver\JWTAuth\Http\Middleware\RefreshToken::class,
]);

// Service Providers
$app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class);
$app->register(App\Providers\EventServiceProvider::class);
$app->register(PHPOpenSourceSaver\JWTAuth\Providers\LumenServiceProvider::class);

// Remove these Passport-related lines:
// $app->register(Laravel\Passport\PassportServiceProvider::class);
// $app->register(Dusterio\LumenPassport\PassportServiceProvider::class);

// Load routes
$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__.'/../routes/web.php';
});

return $app;