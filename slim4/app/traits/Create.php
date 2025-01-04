<?php

namespace app\traits;

use PDOException;

trait Create{
    public function create(array $createfieldsAndValues){

        try{
            $sql = sprintf("insert into %s (%s) values(%s)", $this->table, implode(',', array_keys($createfieldsAndValues)), ':'.implode(',:', array_keys($createfieldsAndValues)));
            $prepared = $this->connection->prepare($sql);
            
            return $prepared->execute($createfieldsAndValues);
        }catch(PDOException $e){
            var_dump($e->getMessage());
        }
    }
}