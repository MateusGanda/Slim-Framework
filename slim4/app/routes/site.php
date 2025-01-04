<?php

use app\controllers\Home;
use app\controllers\Login;

$cache = require '../app/middlewares/cache.php';

//$app->add(new \Slim\HttpCache\Cache('public', 10)); //30 segundos

//$app->get('/', Home::class . ':index')->add($cache('site/home')); para ussar com o cache

$app->get('/', Home::class . ':index');
$app->get('/login', Login::class . ':index');
$app->post('/login', Login::class . ':store');
$app->get('/logout', Login::class . ':destroy');
