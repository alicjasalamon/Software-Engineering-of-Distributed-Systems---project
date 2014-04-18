<?php

namespace Application\Utilities\Validators;

use Application\Utilities\Exceptions\InvalidParameterException;

abstract class Validator {
        
    protected function throwException($name) {
        throw new InvalidParameterException($name);
    }
    
    protected function validateParamExists($params, $name) {
        if(!array_key_exists($name, $params)) {
            $this->throwException($name);
        }
    }
    
    protected function validateParamsExist($params, $names) {
        foreach ($names as $name) {
            $this->validateParamExists($params, $name);
        }
    }
    
    protected function validateRegex($regex, $params, $name) {
        if(!preg_match($regex, $params[$name])) {
            $this->throwException($name);
        }
    }
    
    protected function validateId($params, $name) {
        $this->validateRegex("/^[0-9a-f]{24}$/", $params, $name);
    }
    
    protected function validateDate($params, $name) {
        $this->validateRegex("/^[0-9]{4}(0[1-9]|1[0-2])(0[1-9]|[1-2][0-9]|3[0-1])$/", $params, $name);
    }
    
    protected function validateText($params, $name, $maxLength = 256) {
        $string = $params[$name];
        $isHTML = $this->isHTML($string);
        $isTooLong = strlen($string) > $maxLength;
        if($isHTML || $isTooLong) {
            $this->throwException($name);
        }
    }
    
    protected function validateEmail($params, $name) {
        $this->validateRegex("/^[a-zA-Z][a-zA-Z0-9]{0,64}@[a-zA-Z0-9]{1,64}.[a-zA-Z0-9]{1,16}$/", $params, $name);
    }
    
    private function isHTML($string) {
        return preg_match("/<[^<]+>/", $string);
    }
    
    
}
