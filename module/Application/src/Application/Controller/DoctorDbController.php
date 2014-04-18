<?php

namespace Application\Controller;

use Application\Controller\DbController;
use Application\Controller\Validators\DoctorValidator;

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
            $json = $this->generateJSONViewModel(0, '', $doctorJson);
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
            $json = $this->generateJSONViewModel(0, '', $doctorsJson);
        } catch (Exception $ex) {
            $json = $this->generateFailedJSONViewModel($ex);
        }
        return $json;
    }
    
}
