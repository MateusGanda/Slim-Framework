<?php
//vai colocar todas as validações aqui

namespace app\traits;

trait Validations{

    private $errors = [];

    protected function required($field){
        if(empty($_POST[$field])) {
            $this->errors[$field][] = flash($field, error('Esse campo é obrigatório!'));
            //errors[$field] Vai gravar dentro desse array errors   [] - para não mandar a mensagem 1 de cada vez
        }
        //dd('required');
    }

    protected function email($field){
        //dd($_POST[$field]);
        if(!filter_var($_POST[$field],FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = flash($field, error('Esse campo tem que ter um email válido'));
        }
    }

    protected function phone($field){
        if(!preg_match("/[0-9]{5}\-[0-9]{4}/", $_POST[$field])) {//Expressão regular com numeros de 0 a 9 nas 5 caracteres, o traço(-), e numeros de 0 a 9 nos 4 caracteres
            $this->errors[$field][] = flash($field, error('Esse formato é invalido, por favor utilize o formato xxxxx-xxxx'));
        }    
        
    }

    protected function unique($field, $model){
        $model = "app\\models\\".ucfirst($model);

        $model = new $model();

        $find = $model->select()->where($field,$_POST[$field])->first();

        if($find and !empty($_POST[$field])) { //se encontrar e o field não estiver vazio
            $this->errors[$field][] = flash($field, error('Esse valor já está cadastrado no banco de dados'));    
        }
        //dd($model); vai mostrar posts do email 
    }

    protected function max($field, $max ){
        if(strlen($_POST[$field]) > $max){
            $this->errors[$field][] = flash($field, error("O número de caracteres para este campo não pode ser maior que {$max}"));
        }
        
    }

    public function hasErrors(){
        return !empty($this->errors); //se tiver algo ele retorna verdadeiro 
                                    //se não tiver algo ele retorna falso
    }

    public function errors(){
        dd($this->errors);
    }
}