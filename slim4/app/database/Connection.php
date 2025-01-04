<?php

namespace app\database;

use PDO;
use PDOException;

class Connection{

    private static $pdo = null;

    public static function connection(){

        try{ 
            if(!static::$pdo){ //se não existir uma conexão nesse pdo ele retorna essa mesma conexão
                static::$pdo = new PDO('mysql:host=localhost;dbname=slim4', 'root', '', [ //se der erro troque o localhost por 127.0.0.1
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //erros do tipo exception
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ //o retorno do banco de dados vai ser do tipo obj
                ]);
            }

            
            return static::$pdo;
        }catch(PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}