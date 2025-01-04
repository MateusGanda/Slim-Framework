<?php

namespace app\controllers\admin;

use app\controllers\Controller;
use app\models\admin\Admin;
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

	}

	public function edit() {

	}

	public function update() {

		$validate = new Validate;

		$data = $validate->validate([
			'file' => 'image',
		]);

		if ($validate->hasErrors()) {
			return back();
		}

		$admin = new Admin;
		$adminEncontrado = $admin->getUser();

		$imagem = new Image('file');
		$imagem->delete($adminEncontrado->photo);
		$imagem->size('user')->upload();

		$admin->find('id', $adminEncontrado->id)->update([
			'photo' => "/assets/imgs/photos/{$imagem->getName()}",
		]);

		flash('message_photo_user', success('Upload feito com sucesso'));

		back();

	}

	public function destroy() {

	}

}
