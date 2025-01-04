<?php

namespace app\traits;

use app\models\Paginate;

trait Read{

    private $binds;

    private $isPaginate = false;

    private $paginate;

    public function select($fields = '*'){
        $this->sql = "select {$fields} from {$this->table}";

        return $this;
    }

    public function where(){
        
        $num_args = func_num_args();

        $args = func_get_args();

        $args = $this->whereArgs($num_args,$args);

        $this->sql.= " where {$args['field']} {$args['sinal']} :{$args['field']}";

        //dd($this->sql);
        $this->binds = [
            $args['field'] => $args['value']
        ];

        return $this; 
    }

    private function whereArgs($num_args, $args){
        if($num_args < 2){
            throw new \Exception("Opa, algo errado aconteceu, where precisa de no mínimo 2 argumentos");
        }

        //dd($args);

        if($num_args == 2){
            $field = $args[0];
            $sinal = '=';
            $value = $args[1];
        }

        if($num_args == 3){
            $field = $args[0];
            $sinal = $args[1];
            $value = $args[2];
        }

        if($num_args > 3){
            throw new \Exception("Opa, algo errado aconteceu, where não pode ter mais de 3 argumentos");
        }

        return [
            'field' => $field,
            'sinal' => $sinal,
            'value' => $value
        ];
    }

    public function paginate($perPage) {
        $this->paginate = new Paginate;

        $this->paginate->records($this->count()); 

        $this->paginate->paginate($perPage);

        $this->sql .= $this->paginate->sqlPaginate(); 

        return $this;
    }

    public function links() {
        return $this->paginate->links();
    }

    public function busca($fields){
        
        $fields = explode(',', $fields);

        //dd($fields); //Array ( [0] => name [1] => email )
        $this->sql.=' where';
        foreach ($fields as $field) {
            $this->sql.=" {$field} like :{$field} or";
            $this->binds[$field] = "%".busca()."%";
        }

        $this->sql = rtrim($this->sql, 'or'); //Tira o or do final
        //dd($this->sql); select * from users where name like :name or email like :email

        return $this;
    }

    public function get(){
        $select = $this->bindAndExecute();

        return $select->fetchAll();
    }

    public function first(){
        $select = $this->bindAndExecute();

        return $select->fetch();
    }

    public function count(){
        $select = $this->bindAndExecute();

        return $select->rowCount();
    }

    private function bindAndExecute(){
        $select = $this->connect->prepare($this->sql);

        $select->execute($this->binds); 

        return $select;
    }

}