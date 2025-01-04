<?php

namespace app\controllers;

use app\models\Posts;
use app\models\Users;

class HomeController extends Controller{

    public function index(){
        
        $user = new Users;
        $users = $user->select()->busca('name,email')->paginate(2)->get(); //get pega todos os registros. first() pega somente o primeiro registro
                                            //O first é interessante usar para quando for pegar 1 pessoa tipo ->where('id','5')
                                            //O get é interessante usar para quando for pegar mais de 1 pessoa tipo ->where('id','>','5')
        //$post = new Posts;
        //$posts = $post->posts()->busca('title,description')->paginate(2)->get();

        $this->view('home', [
            'users' => $users,
            'title' => 'Home',
            //'posts' => $posts,
            //'links' => $post->links(),
            'links' => $user->links(),
        ]);
    }

}