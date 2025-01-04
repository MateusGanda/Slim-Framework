<?php

use app\models\admin\Admin;
use app\src\Flash;

$message = new Twig\TwigFunction('message', function ($index) {
	echo Flash::get($index);
});

$admin = new Twig\TwigFunction('admin', function () {
	return Admin::getUser();
});

return [
	$message, $admin
];