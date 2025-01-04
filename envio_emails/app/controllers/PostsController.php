<?php

namespace app\controllers;

use app\models\Posts;

class PostsController extends Controller{

	protected $post;

    public function __construct()
    {
        $this->post = new Posts;
    }

    public function index(){
        //pega o all do Model.php
        $posts = $this->post->all();
        //$posts = $this->post->postsWithIdGreaterThan2(); se usasse a função que está no Posts.php

        $this->view('posts',[
            'title' => 'Lista de posts',
            'posts' => $posts
        ]);
    }

}