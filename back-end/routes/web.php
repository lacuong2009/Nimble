<?php

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

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group([
    'prefix' => 'oauth',
    'namespace' => '\App\Http\Controllers',
], function () use ($router) {
    $router->post('/register','UsersController@register');
    (new \App\Common\Route\RouteRegistrar($router))->all();
});

$router->group([
    'prefix' => 'oauth',
    'namespace' => '\App\Http\Controllers\Auth',
], function () use ($router) {
    (new \App\Common\Route\RouteRegistrar($router))->all();
});

$router->group([
    'prefix' => 'api',
    'namespace' => '\App\Http\Controllers',
    'middleware' => ['auth']
], function () use ($router) {
    // User
    $router->get('/users/me','UsersController@me');
    $router->get('/users/{username}','UsersController@show');

    // keywords
    $router->get('/keywords','KeywordController@search');
    $router->get('/keywords/{id}','KeywordController@show');
    $router->post('/keywords/file-upload','KeywordController@upload');
});


