<?php

namespace app\traits;

trait Sanitize{

    protected function sanitize(){
        $sanitized = [];

        foreach ($_POST as $field => $value) {
            $sanitized[$field] = filter_var($value, FILTER_SANITIZE_STRING); //value é o que a pessoa digitou
        }

        return $sanitized;
    }
}