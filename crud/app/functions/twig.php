<?php

use app\src\Flash;
use Twig\TwigFunction;

$message = new TwigFunction('message', function($index){
    //return Flash::get($index);
    echo Flash::get($index); // para a mensagem de erro aparecer certo
});


return [
    $message,
];