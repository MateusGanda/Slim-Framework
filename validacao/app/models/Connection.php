<?php

namespace app\models;

use PDO;

class Connection{

    public static function connect(){ //PDO - PHP Data Object - extensão para acesso a banco de dados

        $pdo = new PDO("mysql:host=localhost;dbname=twig_slim;charset=utf8","root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Caso dê erro
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); //Ao resgatar os dados eu quero da forma de objto
        
        return $pdo;
    }

}