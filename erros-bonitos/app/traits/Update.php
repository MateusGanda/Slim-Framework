<?php

namespace app\traits;

trait Update{

    public function update($attributes){

        if(!isset($this->field) or !isset($this->value)){
            throw new \Exception("Antes de fazer o update, por favor chame o find");
        }

        $sql = "update {$this->table} set ";

        foreach($attributes as $field => $value){
            $sql.= $field."= :{$field},";
        }

        $sql = rtrim($sql,','); //Serve para tirar o virgula do fim 

        $sql.= " where {$this->field} = :{$this->field}";
        //dd($sql); // update users set name= :name,email= :email where id = :id  (O name e o email ja tem )
        
        $attributes['id'] = $this->value; //Faz com que pegue o id também

        $update = $this->connect->prepare($sql);
        $update->execute($attributes);

        return $update->rowCount(); //1 se for atualizado com sucesso e 0 se n foi atualizado com sucesso
    }

}