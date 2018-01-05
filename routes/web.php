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

$router->get('/', 'Controller@index');


// routes for api
$router->group(['prefix' => 'api/v1'], function () use ($router) {
    // person controller
    $router->group(['prefix' => 'person'], function () use ($router) {

        // search
        $router->get('/get-all', 'PersonController@getAll');
        $router->get('/search', 'PersonController@search');

        // crud
        $router->post('/create', 'PersonController@create');
        $router->get('/{id}', 'PersonController@read');
        $router->put('/{id}', 'PersonController@update');
        $router->delete('/{id}', 'PersonController@delete');
    });
});
