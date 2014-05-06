<?php

namespace Application\Utilities\Validators;

use Application\Utilities\Validators\Validator;

class EventValidator extends Validator {

    public function validateAdd($params) {
        $this->validateParamsExist($params, ['patientid', 'date', 'activity', 'title', 'details', 'time', 'duration']);
        $this->validateId($params, 'patientid');
        $this->validateDate($params, 'date');
        $this->validateActivity($params, 'activity');
        $this->validateText($params, 'title');
        $this->validateText($params, 'details');
        $this->validateTime($params, 'time');
        $this->validateDuration($params, 'duration');
    }
    
    public function validateChangeState($params) {
        $this->validateParamsExist($params, ['id', 'state']);
        $this->validateId($params, 'id');
        $this->validateState($params, 'state');
    }
    
    protected function validateActivity($params, $name) {
        $activity = $params[$name];
        $isValid = in_array($activity, ['diet', 'exercises', 'medicines', 'visits']);
        if(!$isValid) {
            $this->throwException($name);
        }
    }
    
    protected function validateTime($params, $name) {
        $this->validateRegex("/^(([0-1][0-9])|(2[0-3])):(00|20|40)$/", $params, $name);
    }
    
    protected function validateDuration($params, $name) {
        $duration = (int)$params[$name];
        $isValid = in_array($duration, [15, 30, 45, 60, 75, 90, 105, 120], true);
        if(!$isValid) {
        $this->throwException($name);
        }
    }
    
    protected function validateState($params, $name) {
        $state = $params[$name];
        $isValid = in_array($state, ['future', 'inprogress', 'done', 'undone']);
        if(!$isValid) {
            $this->throwException($name);
        }
    }
    
}
