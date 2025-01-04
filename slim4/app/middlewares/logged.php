<?php

use Slim\Psr7\Response;

$logged = function ($request, $handler) {
    $response = $handler->handle($request);
    $existingContent = (string) $response->getBody(); //pega todo o conteúdo da página

    $response = new Response();
    $response->getBody()->write($existingContent);

    if(!isset($_SESSION['is_logged_in'])){
        return redirect($response, '/');
    }

    return $response;
};