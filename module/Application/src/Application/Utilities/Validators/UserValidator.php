<?php

namespace Application\Utilities\Validators;

use Application\Utilities\Validators\Validator;

class UserValidator extends Validator {
    
    public function validateAdd($params) {
        $this->validateParamsExist($params, ['login', 'password', 'group']);
        $this->validateCredential($params, 'login');
        $this->validateCredential($params, 'password');
        $this->validateGroup($params, 'group');
        $group = $params['group'];
        if(substr_count('patientdoctor', $group) > 0) {
            $this->validateSubUser($params, $group);
        } else if ($group == 'admin') {
            // no extra params for admin
        }
    }
    
    protected function validateSubUser($params, $group) {
        $this->validateParamsExist($params, ['institution', 'firstname', 'lastname', 'email']);
        $this->validateId($params, 'institution');
        $this->validateText($params, 'firstname');
        $this->validateText($params, 'lastname');
        $this->validateEmail($params, 'email');
        switch($group){
            case 'patient':
                $this->validateParamExists($params, 'doctor');
                $this->validateId($params, 'doctor');
                break;
            case 'doctor':
                // no extra params for doctor
                break;
        }
    }
    
    protected function validateCredential($params, $name) {
//        $this->validateRegex("/^[a-zA-Z0-9]{4,32}$/", $params, $name);
        //$this->validateText($params, $name, 32);
     
    }
    
    protected function validateGroup($params, $name) {
        $this->validateRegex("/^(patient|doctor|admin)$/", $params, $name);
    }
    
}
