<?php
//  ../ volta uma pasta
require "../bootstrap.php";

$app->get('/','app\controllers\HomeController:index'); //método index
$app->get('/cadastro','app\controllers\CadastroController:create'); //mostrar o formulário para cadastrar
$app->post('/cadastro/store','app\controllers\CadastroController:store'); //cadastro
$app->get('/user/edit/{id}','app\controllers\UserController:edit'); //Edição
$app->post('/user/update/{id}','app\controllers\UserController:update'); //Atualização
$app->get('/user/delete/{id}','app\controllers\UserController:destroy'); //Deleção

$app->run();