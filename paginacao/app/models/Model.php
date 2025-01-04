<?php

namespace app\models;

use app\traits\Read;
use app\traits\Create;
use app\traits\Update;
use app\traits\Delete;

use app\models\Connection;

abstract class Model{

    use Create,Read,Update,Delete;

    protected $connect;
    protected $field;
    protected $value;
    protected $sql;
    protected $table;

    public function __construct()
    {
        $this->connect = Connection::connect();        
    }

    public function all(){
        $this->sql = "select * from {$this->table}"; //esse table vem de posts
       
        return $this;
    }

    public function find($field, $value){   //mudei para users o users
       $this->field = $field;

       $this->value = $value;

       return $this;
    }

    public function destroy($field,$value){
        $sql = "delete from {$this->table} where {$field} = :{$field}";
        $delete = $this->connect->prepare($sql);
        $delete->bindValue($field,$value);
        $delete->execute();


        return $delete->rowCount();
    }

}