<?php

namespace Application\Controller;

use Application\Controller\DbController;

class PatientDbController extends DbController {
    
    public function indexAction() {
        $params = $this->getParams();
        try {
            $patient = $this->patientModel()->get($params);
            $patientJson = $patient ? $patient->toArray(true) : [];
            $json = $this->generateJSONViewModel(0, '', $patientJson);
        } catch (Exception $ex) {
            $json = $this->generateJSONViewModel(1, $ex->getMessage(), null);
        }
        return $json;
    }
    
    public function allAction() {
        try {
            $patients = $this->patientModel()->getAll();
            $patientsJson = [];
            foreach($patients as $patient) {
                $json = $patient->toArray(true);
                array_push($patientsJson, $json);
            }
            $json = $this->generateJSONViewModel(0, '', $patientsJson);
        } catch (Exception $ex) {
            $json = $this->generateJSONViewModel(1, $ex->getMessage(), null);
        }
        return $json;
    }
    
}
