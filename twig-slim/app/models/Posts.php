<?php

namespace app\models;

class Posts extends Model{
    protected $table = 'posts';

    public function postsWithIdGreaterThan2(){ //método como exemplo
        //criaria o método sql
        // Query SQL para selecionar posts com ID maior que 2
        $sql = "SELECT * FROM posts WHERE id > 1";
        
        // Preparar e executar a consulta
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
        
        // Retornar os resultados da consulta
        return $stmt->fetchAll();
    }
}