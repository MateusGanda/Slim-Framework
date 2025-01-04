<?php

use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;

session_start();

require '../vendor/autoload.php';

use DI\Container;
use Slim\Factory\AppFactory;
use Slim\Middleware\MethodOverrideMiddleware;


$container = new Container();
AppFactory::setContainer($container);

$container->set('cache', function() {
    return new \Slim\HttpCache\CacheProvider();
});

$app = AppFactory::create();

// Registrar Middleware no container
$container->set('csrf', function () use ($app){
    $responseFactory = $app->getResponseFactory();
    return new Guard($responseFactory);
});

//var_dump($_SESSION);

require '../app/routes/site.php';
require '../app/routes/user.php';
require '../app/routes/api.php';

$methodOverrideMiddleware = new MethodOverrideMiddleware();
$app->add($methodOverrideMiddleware);

$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
    $response->getBody()->write('Something wrong');
    return $response;
});

$app->run();