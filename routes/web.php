<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->get('/users', 'UserController@index');
$router->post('/users', 'UserController@addUser');
$router->get('/users/{userID}', 'UserController@show'); // get user by id
$router->put('/users/{userID}', 'UserController@updateUser'); // update user record
$router->delete('/users/{userID}', 'UserController@deleteUser'); // delete record

$router->get('/users/search/', 'UserController@searchByName');