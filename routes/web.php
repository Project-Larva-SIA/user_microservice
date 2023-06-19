<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->get('/users', 'UserController@index');
$router->get('/user/{userID}', 'UserController@show'); 
$router->post('/users', 'UserController@addUser');
$router->put('/users/{userID}', 'UserController@updateUser'); 
$router->delete('/users/{userID}', 'UserController@deleteUser');

    // User Features

$router->get('/users/search/', 'UserController@searchByName');