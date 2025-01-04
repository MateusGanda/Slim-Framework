<?php

namespace app\controllers\admin;

use app\controllers\Controller;
use app\models\admin\Admin;
use app\src\Validate;

class PerfilController extends Controller {

	public function edit() {
		$admin = Admin::getUser();

		$this->view('admin.perfil', [
			'title' => 'Editar meus dados',
			'admin' => $admin,
		]);
	}

	public function update() {
		$validate = new Validate;

		$data = $validate->validate([
			'name' => 'required',
			'email' => 'required:email',
		]);

		if ($validate->hasErrors()) {
			return back();
		}

		$admin = new Admin;

		$adminEncontrado = $admin->getUser();

		$updated = $admin->find('id', $adminEncontrado->id)->update((array) $data);

		if ($updated) {
			flash('message', success('Atualizado com sucesso'));

			return back();
		}

		flash('message', error('Erro ao atualizar, tente novamente'));
		back();
	}

}
