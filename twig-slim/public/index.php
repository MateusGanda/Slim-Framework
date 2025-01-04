<?php
//  ../ volta uma pasta
require "../bootstrap.php";

use Slim\Http\Request;
use Slim\Http\Response;


//exemplos para entendimento

// localhost:8888/admin/login
// $app->group('/admin', function() use($app){
//     $app->get('/login',function(){
//         echo 'login';
//     });
// });

// localhost:8888/site/contato
// $app->group('/site', function() use($app){
//     $app->get('/contato',function(){
//         echo 'contato';
//     });
// });

//Pega do dd do app/functions/helpers.php      o $response é o status, para ver se ele está bem (status 200)
// $app->get('/update/user/{id}', function(Request $request, Response $response, array $args){    function = callbacks
//     dd($args['id']);
// });




// '/' signifca que é a página inicial
//Parte dos controllers
$app->get('/','app\controllers\HomeController:index'); //método index
$app->get('/user/{id}', 'app\controllers\UserController:show'); //método show
$app->get('/contato', 'app\controllers\ContatoController:index');
$app->get('/posts', 'app\controllers\PostsController:index');
$app->post('/user/subscribe', 'app\controllers\SubscribeController:store');

$app->run();