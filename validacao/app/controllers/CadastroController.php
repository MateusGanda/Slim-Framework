<?php

namespace app\controllers;

use app\models\Users;
use app\src\Validate;

class CadastroController extends Controller {

    public function create() {
        $this->view('cadastro',[
            'title' => 'Cadastro'
        ]);
    }

    public function store() {
       
        $validate = new Validate;
        // método validate 
        $data = $validate->validate([     //o 'name','email','phone' pega la do cadastro html(input com name)
            'name' => 'required',
            'email' => 'required:email:unique@users', //:email:unique@posts - validação(tipo email, unico seguindo a tabela posts)
            'phone' => 'required:phone',
        ]);

        //$validate->errors();

        if($validate->hasErrors()) {
            return back();
        }

        $user = new Users;
		$user = $user->create((array)$data);

		if($user){
			flash('message',success('Cadastrado com sucesso !'));

			return back();
		}


    }
}