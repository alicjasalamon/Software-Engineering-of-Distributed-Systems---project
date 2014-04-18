<?php

namespace Application\Utilities\Validators;

use Application\Utilities\Validators\Validator;

class PatientValidator extends Validator {
    
    public function validateGet($params) {
        $this->validateParamExists($params, 'id');
        $this->validateId($params, 'id');
    }
    
}
