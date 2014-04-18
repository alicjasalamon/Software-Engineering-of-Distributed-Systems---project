<?php

namespace Application\Controller\Validators;

use Application\Controller\Validators\Validator;

class PatientValidator extends Validator {
    
    public function validateGet($params) {
        $this->validateParamExists($params, 'id');
        $this->validateId($params, 'id');
    }
    
}
