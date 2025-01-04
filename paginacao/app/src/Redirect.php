<?php

namespace app\src;

class Redirect {
    public static function redirect($target) {
        return header("location:{$target}");
    }

    public static function back(){
        $previous = "javascript:history.go(-1)"; //"javascript:history.go(-1)" redireciona para a página anterior

        if(isset($_SERVER["HTTP_REFERER"])) { //Se existir essa variavel super global com esse indice HTTP_REFERER no navegador, ele vai guardar no $previous 
            $previous = $_SERVER["HTTP_REFERER"];
        }

        return header("location:{$previous}");
    }
}