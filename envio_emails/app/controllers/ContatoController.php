<?php

namespace app\controllers;

use app\src\Validate;
use app\src\Email;
use app\templates\Contato;

class ContatoController extends Controller{
    //No contato.html o {{ teste() }}  vem da função twig.php em app\functions\twig.php
    public function index(){
        $this->view('contato',[
            'title' => 'Contato', //Para chamar no contato.html usa o  {{ title }}  
            'nome' => 'Alexandre' //Para chamar no contato.html usa o  {{ nome }}  
        ]);
    }

    public function store(){

        $validate = new Validate;

        $data = $validate->validate([
            'name' => 'required',
            'email' => 'required:email',
            'assunto' => 'required',
            'mensagem' => 'required'
        ]);

        if($validate->hasErrors()){
            return back();
        }

        $email = new Email;

        $email->data([
            'fromName' => $data->name,
            'fromEmail' => $data->email,
            'toName' => 'Mateus Ganda',
            'toEmail' => 'mateusmganda@gmail.com',
            'assunto' => $data->assunto,
            'mensagem' => $data->mensagem,
        ])->template(new Contato)->send();
    }

}