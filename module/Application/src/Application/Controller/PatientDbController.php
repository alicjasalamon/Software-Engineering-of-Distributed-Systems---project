<?php

namespace Application\Controller;

use Application\Controller\DbController;
use Application\Controller\Validators\PatientValidator;

class PatientDbController extends DbController {
    
    /**
     * @var PatientValidator;
     */
    protected $validator;
    
    public function __construct() {
        $this->validator = new PatientValidator();
    }
    
    public function indexAction() {
        $params = $this->getParams();
        try {
            $this->validator->validateGet($params);
            $patient = $this->model()->patientModel()->get($params);
            $patientJson = $patient ? $patient->toArray(true) : [];
            $json = $this->generateJSONViewModel(0, '', $patientJson);
        } catch (InvalidParameterException $ex) {
            $json = $this->generateInvalidParamsJSONViewModel($ex);
        } catch (Exception $ex) {
            $json = $this->generateFailedJSONViewModel($ex);
        }
        return $json;
    }
    
    public function allAction() {
        try {
            $patients = $this->model()->patientModel()->getAll();
            $patientsJson = [];
            foreach($patients as $patient) {
                $json = $patient->toArray(true);
                array_push($patientsJson, $json);
            }
            $json = $this->generateJSONViewModel(0, '', $patientsJson);
        } catch (Exception $ex) {
            $json = $this->generateFailedJSONViewModel($ex);
        }
        return $json;
    }
    
}
