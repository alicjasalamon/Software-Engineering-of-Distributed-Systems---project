<?php

namespace Application\Controller;
use Application\Controller\DbController;

class PatientController extends DbController {
    
    public function indexAction() {
        $params = $this->getParams();
        try {
            $doctorJson = $this->patientModel()->get($params);
            $json = $this->generateJSONViewModel(0, '', $doctorJson);
        } catch (Exception $ex) {
            $json = $this->generateJSONViewModel(1, $ex->getMessage(), null);
        }
        return $json;
    }
    
    public function allAction() {
        try {
            $patients = $this->patientModel()->getAll();
            $json = $this->generateJSONViewModel(0, '', $patients);
        } catch (Exception $ex) {
            $json = $this->generateJSONViewModel(1, $ex->getMessage(), null);
        }
        return $json;
    }
    
}
