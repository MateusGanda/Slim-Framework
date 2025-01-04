<?php

namespace App\Traits;

trait Create{

    public function create($attributes){

        $sql = "insert into {$this->table}(";
        $sql.= implode(',', array_keys($attributes)).') values(' ; //Concatenou com a parte de cima
        $sql.= ":".implode(', :',array_keys($attributes)).')';

        $create = $this->connect->prepare($sql);

        $create->execute($attributes);

        return $this->connect->lastInsertId();
    }

}