<?php

namespace Application\Controller\Db;

use Application\Utilities\Validators\EventValidator;

class EventDbController extends DbController {
    
    /**
     * @var EventValidator
     */
    protected $validator;
    
    public function __construct() {
        $this->validator = new EventValidator();
    }

    public function addAction() {
        return $this->wrapSingleResultAction(function($params) {
            $this->validator->validateAdd($params);
            $event = $this->model()->patientModel()->addEvent($params);
            return $event;
        });
    }
    
    public function stateAction() {
        return $this->wrapSingleResultAction(function($params) {
           $this->validator->validateChangeState($params);
           $event = $this->model()->eventModel()->setState($params);
           return $event;
        });
    }
    
    public function measurementAction() {
        return $this->wrapSingleResultAction(function($params) {
            $this->validator->validateSetMeasurementValue($params);
            $event = $this->model()->eventModel()->setMeasurementValue($params);
            return $event;
        });
    }
    
    public function deleteAction() {
        return $this->wrapSingleResultAction(function($params) {
            $this->validator->validateDelete($params);
            $event = $this->model()->eventModel()->deleteEvent($params);
            return $event;
        });
    }

}

