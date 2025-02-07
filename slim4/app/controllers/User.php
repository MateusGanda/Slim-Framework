<?php

namespace app\controllers;

use app\classes\Csrf;
use app\classes\Flash;
use app\classes\Validate;
use app\database\models\User as ModelsUser;
use Psr\Container\ContainerInterface;

class User extends Base{

    private $validate;
    private $user;
    private $container;

    public function __construct(ContainerInterface $container){
        $this->validate = new Validate;
        $this->user = new ModelsUser;
        $this->container = $container;
    }

    public function create($request, $response, $args){

        $messages = Flash::getAll();

        $csrf = $this->container->get('csrf');
        
        $crossSiteRequestForgery = Csrf::csrf($request, $csrf);
        //var_dump($messages);
        return $this->getTwig()->render($response, $this->setView('site/user_create'), [
            'title' => 'User Create',
            'messages' => $messages,
            'csrf' => $crossSiteRequestForgery,
        ]);
        //Flash::set('message','teste3');
        //return redirect($response, '/');
    }

    public function edit($request, $response, $args){
        $id = filter_var($args['id'], FILTER_SANITIZE_NUMBER_INT); //pega o id do user

        $user = $this->user->findBy('id', $id);

        if(!$user){// se não achar o user
            Flash::set('message', 'Usuário não existe', 'danger');
            return redirect($response, '/');
        }

        $messages = Flash::getAll();

        return $this->getTwig()->render($response, $this->setView('site/user_edit'), [
            'title' => 'User edit',
            'user' => $user,
            'messages' => $messages,
        ]);
    }

    public function store($request, $response, $args){
        
        $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
        $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $this->validate->required(['firstName', 'lastName', 'email', 'password'])->exist($this->user, 'email', $email);
        $errors = $this->validate->getErrors();

        if($errors){
            Flash::flashes($errors);
            return redirect($response, '/user/create');
        }

        $created = $this->user->create(['firstName' =>$firstName, 'lastName' => $lastName, 'email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT)]);

        if($created) { //Cadastro do user
            Flash::set('message','Cadastrado com sucesso');
            return redirect($response, '/');
        }
        //Se não der para cadastrar
        Flash::set('message','Ocorreu um erro ao cadastrar o user');
        return redirect($response, '/user/create');
    }

    public function update($request, $response, $args){
        
        $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING); //todos os filtros
        $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $id = filter_var($args['id'], FILTER_SANITIZE_NUMBER_INT);

        $this->validate->required(['firstName', 'lastName', 'email', 'password']);
        $errors = $this->validate->getErrors();

        if($errors){
            Flash::flashes($errors);
            return redirect($response, '/user/edit/' . $id);
        }

        $updated = $this->user->update(['fields' => ['firstName' => $firstName, 'lastName' => $lastName, 'email' => $email, 'password' => \password_hash($password, PASSWORD_DEFAULT)], 
        'where' => ['id' => $id]]);

        if($updated){
            Flash::set('message', 'Atualizado com sucesso');
            return redirect($response, '/user/edit/' . $id);
        }

        Flash::set('message','Ocorreu um erro ao atualizar', 'danger');
        return redirect($response, '/user/edit/' . $id);

    }

    public function destroy($request, $response, $args){
        $id = filter_var($args['id'], FILTER_SANITIZE_NUMBER_INT);

        $user = $this->user->findBy('id', $id);

        if(!$user){// se não achar o user
            Flash::set('message', 'Usuário não existe', 'danger');
            return redirect($response, '/');
        }

        $deleted = $this->user->delete('id', $id);

        if($deleted){
            Flash::set('message', 'Deletado com sucesso');
            return redirect($response, '/');
        }

        Flash::set('message','Ocorreu um erro ao deletar', 'danger');
        return redirect($response, '/');
    }
}