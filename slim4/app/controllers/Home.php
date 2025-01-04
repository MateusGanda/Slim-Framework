<?php

namespace app\controllers;

use app\classes\Cache;
use app\classes\CacheHtml;
use app\classes\Flash;
use app\database\models\User;
use Psr\Container\ContainerInterface;

class Home extends Base{

    private $user;
    private $container;
    
    public function __construct(ContainerInterface $container){
        $this->user = new User();
        $this->container = $container;
        
    }
    public function index($request, $response){

    /*  $start = microtime(true);
        $users = Cache::get('users');   ---> SISTEMA DE CACHE
        if(!$users){
            $users = $this->user->find();
            Cache::set('users', $users);
        }
        $cacheHtml = CacheHtml::get('site/home'); */

        $users = $this->user->find();

        $message = Flash::get('message');

        $cache = $this->container->get('cache');

        //$responseEtag = $cache->withEtag($response, md5(time()));
        //$responseEtag = $cache->withExpires($response, '+50 seconds');
        $responseEtag = $cache->withLastModified($response, '-50 seconds');

        //$settings = $this->container->get('settings');

        //var_dump($settings);

        $view = $this->getTwig()->render($responseEtag, $this->setView('site/home'), [ //setView($cacheHtml) na parte do cache
            'title' => 'Home',
            'users' => $users,
            'message' => $message,
        ]);

        //$end = microtime(true); -> Parte do cache também

        //echo ($end - $start) / 1000;

        //return $response;
        return $view;
        //$message = Flash::get('message');
        //var_dump($message);

        //FLASH MESSAGES
        //Flash::set('message', 'cadastrado com sucesso');
        //$message = Flash::get('message');

        //READ
        //$userFind = $this->user->findBy('email', 'xandecar@hotmail.com');
        //var_dump($userFind);

        //CREATE
        //$created = $this->user->create(['firstName' => 'djshd', 'email' => 'sskds', 'password' => 'sskasds']);
        
        //UPDATE
        //$updated = $this->user->update(['fields' => ['firstName' => 'Alexandre', 'email' => 'teste@teste.com.br'], 'where' => ['id' => 2]]);
        //var_dump($updated);
        //"update users set firstName = :firstName, email = :email where id = :id";

        //DELETE
        //$deleted = $this->user->delete('id', 7);
        //var_dump($deleted);

        //var_dump($this->validate->getErrors());
        
    }

    public function edit(){

    }
}