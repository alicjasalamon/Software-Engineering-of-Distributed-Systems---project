<?php

namespace Application\Controller\Validators;

use Application\Controller\Validators\Validator;

class DayValidator extends Validator {
    
    public function validateGet($params) {
        $this->validateParamsExist($params, ['patientid', 'date']);
        $this->validateId($params, 'patientid');
        $this->validateDate($params, 'date');
    }

}
