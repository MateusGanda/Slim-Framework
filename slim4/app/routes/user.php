<?php

use app\Controllers\User;

require '../app/middlewares/logged.php';

//$app->get('/user/create', User::class . ':create')->add($logged); //so da para criar se estiver logado
$app->get('/user/create', User::class . ':create')->add('csrf');
$app->get('/user/edit/{id}', User::class . ':edit');
$app->post('/user/store', User::class . ':store')->add('csrf');
$app->put('/user/update/{id}', User::class . ':update');
$app->delete('/user/delete/{id}', User::class . ':destroy');