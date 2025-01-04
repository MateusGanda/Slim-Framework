<?php

use app\models\admin\Admin;
use app\src\Flash;
use Carbon\Carbon;


$message = new Twig\TwigFunction('message', function ($index) {
	echo Flash::get($index);
});

$admin = new Twig\TwigFunction('admin', function () {
	return Admin::getUser();
});

$timeAgo = new Twig\TwigFunction('timeAgo', function ($date) {

	Carbon::setLocale('pt-br');

	$created = Carbon::parse($date);

	return $created->diffForHumans();

});

return [
	$message, $admin, $timeAgo,
];