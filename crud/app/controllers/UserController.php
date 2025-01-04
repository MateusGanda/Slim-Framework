<?php

namespace app\controllers;

use app\models\Users;
use app\src\Validate;
use Slim\Http\Request;
use Slim\Http\Response;

class UserController extends Controller{

    private $user;

    public function __construct() {

        $this->user = new Users;
    }

    public function edit(Request $request, Response $response, array $args){
    
        $user = $this->user->select()->where('id', $args['id'])->first();

        $this->view('user',[
            'title' => 'Editar user',
            'user' => $user
        ]);
    }

    public function update(Request $request, Response $response, array $args){

        $validate = new Validate;
        // método validate 
        $data = $validate->validate([     //o 'name','email','phone' pega la do cadastro html(input com name)
            'name' => 'required',
            'email' => 'required:email', //:email:unique@posts - validação(tipo email, unico seguindo a tabela posts)
            'phone' => 'required:phone',
        ]);

        //$validate->errors();

        if($validate->hasErrors()) {
            return back();
        }
       
        $updated = $this->user->find('id', $args['id'])->update((array)$data);

        if($updated){
            flash('message', success('Atualizado com sucesso !'));

            return back();
        }

        flash('message', error('Erro ao atualizar !'));

            return back();
    }

    public function destroy($request, $response, $args){

        $deleted = $this->user->find('id', $args['id'])->delete(); //Usa o método delete
        //$deleted = $this->user->destroy('id',$args['id']); deleta diretamente

        if($deleted){
            return redirect('/');
        }

    }
}