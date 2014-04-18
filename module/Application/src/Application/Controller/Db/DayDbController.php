<?php

namespace Application\Controller\Db;

use Application\Utilities\Validators\DayValidator;
use Application\Utilities\Exceptions\InvalidParameterException;

class DayDbController extends DbController
{
    /*
     * @var DayValidator
     */
    protected $validator;
    
    public function __construct() {
        $this->validator = new DayValidator();
    }

    public function indexAction() {
        $params = $this->getParams();
        try {
            $this->validator->validateGet($params);
            $day = $this->model()->patientModel()->getDay($params);
            $dayJson = $day ? $day->toArray(true) : [];
            $json = $this->generateDataJSONViewModel($dayJson);
        } catch (InvalidParameterException $ex) {
            $json = $this->generateInvalidParamsJSONViewModel($ex);
        } catch (Exception $ex) {
            $json = $this->generateFailedJSONViewModel($ex);
        }
        return $json;
    }

}

