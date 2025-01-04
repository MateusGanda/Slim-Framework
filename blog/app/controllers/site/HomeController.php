<?php

namespace app\controllers\site;

use app\controllers\Controller;
use app\models\admin\Post;

class HomeController extends Controller {

	public function index() {

		$post = new Post;

		$posts = $post->posts();

		$this->view('site.home', [
			'title' => 'Blog ASW',
			'posts' => $posts,
			'links' => $post->links(),
		]);
	}

}