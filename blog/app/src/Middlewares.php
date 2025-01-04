<?php

namespace app\src;

class Middlewares {

	private $config;

	public function __construct() {
		$this->config = (object) Load::file('/config.php');
	}

	public function admin() {

		$config = $this->config->login['admin'];

		$admin = function ($request, $response, $next) use ($config) {

			if (!isset($_SESSION[$config['loggedIn']])) {
				return $response->withRedirect($config['redirect']);
			}

			$response = $next($request, $response);

			return $response;

		};

		return $admin;

	}

}