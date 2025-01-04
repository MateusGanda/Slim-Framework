<?php

namespace app\controllers\admin;

use app\controllers\Controller;
use app\models\admin\Admin;
use app\models\admin\Post;
use app\src\Validate;

class PostsController extends Controller {

	public function __construct() {
		$this->post = new Post;
	}

	public function index() {

	}

	public function show() {

	}

	public function create() {
		$this->view('admin.post_create', [
			'title' => 'Cadastrar post',
		]);
	}

	public function store() {
		$validate = new Validate;

		$data = $validate->validate([
			'title' => 'required',
			'slug' => 'required',
			'description' => 'required',
		]);

		if ($validate->hasErrors()) {
			return back();
		}

		$created = $this->post->create([
			'title' => $data->title,
			'slug' => $data->slug,
			'description' => $data->description,
			'user' => Admin::getUser()->id,
		]);

		if ($created) {
			flash('message', success('Cadastrado com sucesso'));

			return back();
		}

		flash('message', error('Erro ao cadastrar, tente novamente'));
		return back();
	}

	public function edit($request, $response, $args) {

		$post = $this->post->findBy('id', $args['id']);

		$this->view('admin.post_edit', [
			'title' => 'Atualizar post',
			'post' => $post,
		]);

	}

	public function update($request, $response, $args) {

		$validate = new Validate;

		$data = $validate->validate([
			'title' => 'required',
			'description' => 'required',
		]);

		if ($validate->hasErrors()) {
			return back();
		}

		$updated = $this->post->find('id', $args['id'])->update((array) $data);

		if ($updated) {
			flash('message', success('Atualizado com sucesso'));

			return back();
		}

		flash('message', error('Erro ao atualizar'));
		back();
	}

	public function destroy($request, $response, $args) {

		$postEncontrado = $this->post->findBy('id', $args['id']);

		@unlink(path() . '/public' . $postEncontrado->photo);

		$deleted = $this->post->find('id', $args['id'])->delete();

		if ($deleted) {
			flash('message', success('Deletado com sucesso'));

			return back();
		}

		flash('message', error('Erro ao deletar'));
		back();
	}

}
