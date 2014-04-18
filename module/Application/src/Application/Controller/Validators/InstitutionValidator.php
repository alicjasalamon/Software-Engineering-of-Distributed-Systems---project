<?php

namespace Application\Controller\Validators;

use Application\Controller\Validators\Validator;

class InstitutionValidator extends Validator {
    
    public function validateGet($params) {
        $this->validateParamExists($params, 'id');
        $this->validateId($params, 'id');
    }
    
    public function validateAdd($params) {
        $this->validateParamExists($params, 'name');
        $this->validateText($params, 'name');
    }
    
}
