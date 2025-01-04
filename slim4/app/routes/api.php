<?php
 //Pelo insmonia
use Slim\Routing\RouteCollectorProxy;

//require '../app/middlewares/logged.php';

$app->group('/api', function(RouteCollectorProxy $group) {
    $group->get('/users', function($request, $response){
        $payload = json_encode(['name' => 'Mateus']);
        $response->getBody()->write($payload);

        return $response->withHeader('Content-type', 'application/json', 200);
    });

    $group->get('/data', function($request, $response){
        return $response;
    });
})->add($logged);