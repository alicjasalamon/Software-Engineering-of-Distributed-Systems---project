<?php

namespace Application\Utilities\Validators;

use Application\Utilities\Validators\Validator;

class MeasurementsValidator extends Validator {
    
    public function validateGet($params) {
        $this->validateParamExists($params, 'doctorid');
        $this->validateId($params, 'doctorid');
    }
    
}
