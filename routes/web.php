<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('login', 'AuthController@login');
    $router->post('logout', 'AuthController@logout');
    $router->post('refresh', 'AuthController@refresh');
    $router->get('me', 'AuthController@me');
});

$router->group(['middleware' => 'client.credentials'], function () use ($router) {
    $router->group(['prefix' => 'api'], function () use ($router) {
        // API GATEWAY ROUTES FOR SITE1 users
        $router->get('/users1', 'User1Controller@index');
        $router->post('/users1', 'User1Controller@add');
        $router->get('/users1/{id}', 'User1Controller@show');
        $router->put('/users1/{id}', 'User1Controller@update');
        $router->patch('/users1/{id}', 'User1Controller@update');
        $router->delete('/users1/{id}', 'User1Controller@delete');

        // API GATEWAY ROUTES FOR SITE2 users
        $router->get('/users2', 'User2Controller@index');
        $router->post('/users2', 'User2Controller@add');
        $router->get('/users2/{id}', 'User2Controller@show');
        $router->put('/users2/{id}', 'User2Controller@update');
        $router->patch('/users2/{id}', 'User2Controller@update');
        $router->delete('/users2/{id}', 'User2Controller@delete');
    });
});