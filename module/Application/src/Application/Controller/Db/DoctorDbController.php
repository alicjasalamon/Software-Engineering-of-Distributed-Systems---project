<?php

namespace Application\Controller\Db;

use Application\Controller\DbController;
use Application\Utilities\Validators\DoctorValidator;
use Application\Utilities\Exceptions\InvalidParameterException;

class DoctorDbController extends DbController {

    /**
     * @var DoctorValidator
     */
    protected $validator;
    
    public function __construct() {
        $this->validator = new DoctorValidator();
    }
    
    public function indexAction() {
        $params = $this->getParams();
        try {
            $this->validator->validateGet($params);
            $doctor = $this->model()->doctorModel()->get($params);
            $doctorJson = $doctor ? $doctor->toArray(true) : [];
            $json = $this->generateDataJSONViewModel($doctorJson);
        } catch (InvalidParameterException $ex) {
            $json = $this->generateInvalidParamsJSONViewModel($ex);
        } catch (Exception $ex) {
            $json = $this->generateFailedJSONViewModel($ex);
        }
        return $json;
    }
    
    public function allAction() {
        try {
            $doctors = $this->model()->doctorModel()->getAll();
            $doctorsJson = [];
            foreach($doctors as $doctor) {
                $json = $doctor->toArray();
                array_push($doctorsJson, $json);
            }
            $json = $this->generateDataJSONViewModel($doctorsJson);
        } catch (Exception $ex) {
            $json = $this->generateFailedJSONViewModel($ex);
        }
        return $json;
    }
    
}
