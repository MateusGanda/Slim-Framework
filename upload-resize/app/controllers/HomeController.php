<?php

namespace app\controllers;

use app\models\Users;

class HomeController extends Controller {

	public function index() {

		$user = new Users;
		$users = $user->select()->busca('name,email')->paginate(2)->get();

		$this->view('home', [
			'users' => $users,
			'title' => 'Home',
			'links' => $user->links(),
		]);
	}

}