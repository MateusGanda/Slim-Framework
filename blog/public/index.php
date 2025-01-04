<?php

require "../bootstrap.php";

$app->get('/', 'app\controllers\site\HomeController:index');
$app->get('/post/{slug}', 'app\controllers\site\PostController:show');

$app->get('/login', 'app\controllers\admin\LoginController:index');
$app->post('/login', 'app\controllers\admin\LoginController:store');

$app->group('/admin', function () use ($app) {
	$app->get('/painel', 'app\controllers\admin\PainelController:index');
	$app->get('/post/create', 'app\controllers\admin\PostsController:create');
	$app->post('/post/store', 'app\controllers\admin\PostsController:store');
	$app->get('/post/edit/{id}', 'app\controllers\admin\PostsController:edit');
	$app->get('/post/destroy/{id}', 'app\controllers\admin\PostsController:destroy');
	$app->post('/post/update/{id}', 'app\controllers\admin\PostsController:update');
	$app->post('/post/photo/upload/{id}', 'app\controllers\admin\PostsPhotoController:update');
	$app->get('/perfil/edit', 'app\controllers\admin\PerfilController:edit');
	$app->post('/user/update', 'app\controllers\admin\PerfilController:update');
	$app->post('/user/photo', 'app\controllers\admin\PerfilPhotoController:update');
	$app->get('/logout', 'app\controllers\admin\LoginController:destroy');
})->add($middleware->admin());

$app->run();
