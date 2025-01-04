<?php

namespace app\models;

use app\models\Connection;

class Model{
    protected $connect;
    protected $table;

    public function __construct()
    {
        $this->connect = Connection::connect();        
    }

    public function all(){
        $sql = "select * from {$this->table}"; //esse table vem de posts
        $all = $this->connect->query($sql);
        $all->execute();

        return $all->fetchAll();
    }

}