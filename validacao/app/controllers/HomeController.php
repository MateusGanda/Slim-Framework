<?php

namespace app\controllers;

use app\models\Users;

class HomeController extends Controller{

    public function index(){

        $users = new Users;
        $users = $users->select()->get(); //get pega todos os registros. first() pega somente o primeiro registro
                                            //O first é interessante usar para quando for pegar 1 pessoa tipo ->where('id','5')
                                            //O get é interessante usar para quando for pegar mais de 1 pessoa tipo ->where('id','>','5')

        $this->view('home', [
            'users' => $users,
            'title' => 'Home'
        ]);
    }

}