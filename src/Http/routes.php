<?php

$this->app->get('ping', 'Jkirkby91\LumenRestServerComponent\Http\Controllers\PingController@ping');

/**
 * Generate resource based routes
 *
 * @param $path
 * @param $controller
 */
function resource($path, $controller)
{
    global $app;

    $app->get($path, $controller.'@index');
    $app->get($path.'/{id}', $controller.'@show');
    $app->post($path, $controller.'@store');
    $app->put($path.'/{id}', $controller.'@update');
    $app->delete($path.'/{id}', $controller.'@destroy');
}

/**
 * Generate CRUD based routes
 *
 * @param $path
 * @param $controller
 */
function crud($path, $controller)
{
    global $app;

    $app->post($path, $controller.'@create');
    $app->get($path.'/{id}', $controller.'@read');
    $app->put($path.'/{id}', $controller.'@update');
    $app->delete($path.'/{id}', $controller.'@delete');
}