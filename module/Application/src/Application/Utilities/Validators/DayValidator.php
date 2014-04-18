<?php

namespace Application\Utilities\Validators;

use Application\Utilities\Validators\Validator;

class DayValidator extends Validator {
    
    public function validateGet($params) {
        $this->validateParamsExist($params, ['patientid', 'date']);
        $this->validateId($params, 'patientid');
        $this->validateDate($params, 'date');
    }

}
