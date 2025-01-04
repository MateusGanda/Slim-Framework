<?php

namespace app\controllers;

class ContatoController extends Controller{
    //No contato.html o {{ teste() }}  vem da função twig.php em app\functions\twig.php
    public function index(){
        $this->view('contato',[
            'title' => 'Contato', //Para chamar no contato.html usa o  {{ title }}  
            'nome' => 'Alexandre' //Para chamar no contato.html usa o  {{ nome }}  
        ]);
    }

}