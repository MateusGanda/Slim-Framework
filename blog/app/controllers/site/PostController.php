<?php

namespace app\controllers\site;

use app\controllers\Controller;
use app\models\site\Post;

class PostController extends Controller {

	private $post;

	public function __construct() {
		$this->post = new Post;
	}

	public function show($request, $response, $args) {
		$post = $this->post->findBy('slug', $args['slug']);

		$this->view('site.post', [
			'title' => $args['slug'],
			'post' => $post,
		]);
	}

}