<?php

use app\src\Flash;
use app\src\Redirect;

function dd($data){
    print_r($data);

    die();
}

function json($data){
    header('Content-Type: application/json');

    echo json_encode($data);
}

function path(){
    $vendorDir = dirname(dirname(__FILE__));
    return dirname($vendorDir);
}

function flash($index,$message){
    Flash::add($index,$message);
}

function error($message){
    return "<spam class='error'>* {$message}</span>";
    //return "<spam class='alert alert-danger'>* {$message}</span>"; é do propiro bootstrap
}

function success($message){
    return "<spam class='success'>{$message}</span>";
}

function redirect($target){
    Redirect::redirect($target);

    die();
}

function back(){
    Redirect::back();

    die();
}

function busca(){
    return strip_tags(filter_input(INPUT_GET, 's'));
}
