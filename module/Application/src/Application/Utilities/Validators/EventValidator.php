<?php

namespace Application\Utilities\Validators;

use Application\Utilities\Validators\Validator;

class EventValidator extends Validator {

    public function validateAdd($params) {
        $this->validateParamsExist($params, ['patientid', 'date', 'title', 'details', 'time', 'duration']);
        $this->validateId($params, 'patientid');
        $this->validateDate($params, 'date');
        $this->validateText($params, 'title');
        $this->validateText($params, 'details');
        $this->validateTime($params, 'time');
        $this->validateDuration($params, 'duration');
    }

    protected function validateTime($params, $name) {
        $this->validateRegex("/^(([0-1][0-9])|(2[0-3])):(00|20|40)$/", $params, $name);
    }
    
    protected function validateDuration($params, $name) {
        $duration = $params[$name];
        $isValid = in_array($duration, [0, 20, 40, 60, 80, 100, 120], true);
        if(!$isValid) {
            $this->throwException($name);
        }
    }
    
}
