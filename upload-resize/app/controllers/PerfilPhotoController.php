<?php

namespace app\controllers;

use app\models\Users;
use app\src\Image;
use app\src\Validate;

class PerfilPhotoController extends Controller {

	public function index() {
	}

	public function show() {

	}

	public function create() {

	}

	public function store() {

		$validate = new Validate;
		$validate->validate([
			'file' => 'image',
		]);

		if ($validate->hasErrors()) {
			return back();
		}

		$user = new Users;
		$userEncontrado = $user->select()->where('id', 1)->first(); //vai pegaro id 1

		$imagem = new Image('file');
		$imagem->delete($userEncontrado->photo);
		$imagem->size('user')->upload();

		$user->find('id', 1)->update([
			'photo' => "/assets/imgs/photos/{$imagem->getName()}", //vai cadastrar todo o caminho dessa imagem
		]);

		flash('message', success('Upload feito com sucesso'));

		back();

	}

	public function edit() {

	}

	public function update() {

	}

	public function destroy() {

	}

}
