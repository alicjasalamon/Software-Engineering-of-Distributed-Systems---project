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
        return $this->wrapSingleResultAction(function($params){
            $this->validator->validateAdd($params);
            $event = $this->model()->patientModel()->addEvent($params);
            return $event;
        });
    }

}

