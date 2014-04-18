<?php

namespace Application\Controller;

use Application\Utilities\Validators\EventValidator;
use Application\Utilities\Exceptions\InvalidParameterException;

class EventDbController extends DbController {
    
    /**
     * @var EventValidator
     */
    protected $validator;
    
    public function __construct() {
        $this->validator = new EventValidator();
    }

    public function addAction() {
        $params = $this->getParams();
        try {
            $this->validator->validateAdd($params);
            $event = $this->model()->patientModel()->addEvent($params);
            $eventJson = $event ? $event->toArray(true) : [];
            $json = $this->generateJSONViewModel(0, '', $eventJson);
        } catch (InvalidParameterException $ex) {
            $json = $this->generateInvalidParamsJSONViewModel($ex);
        } catch (Exception $ex) {
            $json = $this->generateFailedJSONViewModel($ex);
        }
        return $json;
    }

}

