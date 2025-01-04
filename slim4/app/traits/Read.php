<?php

namespace app\traits;
use PDOException;

trait Read{

    public function find($fetchAll = true){
        
        try{
            $query = $this->connection->query("select * from {$this->table}");
            return $fetchAll ? $query->fetchAll() : $query->fetch(); //se for true retorna o fetchAll() senao retorna o fetch()

           // $prepare = $this->connection->prepare("select * from {$this->table} where name = :name");
           // $prepare->bindValue(':name', 'Alexandre'); O prepare ´mais usado quando se quer usar a substituição
        }catch(PDOException $e){
            var_dump($e->getMessage());
        }
    }

    public function findBy($field, $value, $fetchAll = false) {

        try{
            $prepared = $this->connection->prepare("select * from {$this->table} where {$field} = :{$field}");
            $prepared->bindValue(":{$field}", $value); //Vai substituir o field pelo value
            $prepared->execute();
            return $fetchAll ? $prepared->fetchAll() : $prepared->fetch();
        }catch(PDOException $e){
            var_dump($e->getMessage());
        }
    }
}