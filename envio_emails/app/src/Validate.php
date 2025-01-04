<?php

namespace app\src;

use app\traits\Sanitize;
use app\traits\Validations;

class Validate{

    use Validations, Sanitize;

    public function validate($rules){
        foreach($rules as $field => $validation){ //$field são os 'name','email' || validation são os 'required:max@30','required:email:unique@posts'
            
            $validation = $this->validationWithParameter($field, $validation);


            if($this->hasOneValidation($validation)){
                $this->$validation($field);
            }

            if($this->hasTwoOrMoreValidation($validation)){
                $validations = explode(':', $validation);

                foreach($validations as $validation) {
                    $this->$validation($field);
                }
            }
        } 

        return (object) $this->sanitize();
    }

    private function validationWithParameter($field, $validation){

        $validations = [];

        if(substr_count($validation, '@') > 0) {
            $validations = explode(':', $validation);
        }

        foreach($validations as $key => $value){ 
            if(substr_count($value,'@') > 0) {
                
                list($validationWithParameter, $parameter) = explode('@', $value); //transforma string em um array

                //dd($validationEithParameter); vai pegar max
                //dd($parameter); vai pegar o 5

                $this->$validationWithParameter($field, $parameter);

                unset($validations[$key]); //tirei os validations que tem o @

                $validation = implode(':', $validations);
            }
        }

        return $validation;

        //dd($validation);
    }

    private function hasOneValidation($validate){
        return substr_count($validate, ':') == 0; //o número de : dessa validação for igual a 0
    }

    private function hasTwoOrMoreValidation($validate){
        return substr_count($validate, ':') >= 1; //o número de : dessa validação for maior ou igual a 1
    }
}