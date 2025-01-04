<?php

namespace app\controllers\admin;

use app\controllers\Controller;
use app\models\admin\Post;

class PainelController extends Controller {

	public function index() {

		$post = new Post;
		$posts = $post->posts();

		$this->view('admin.painel', [
			'title' => 'Painel administrativo',
			'posts' => $posts,
			'links' => $post->links(),
		]);
	}

	public function show() {

	}

	public function create() {

	}

	public function store() {

	}

	public function edit() {

	}

	public function update() {

	}

	public function destroy() {

	}

}
