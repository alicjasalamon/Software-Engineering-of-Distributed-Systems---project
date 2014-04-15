<?php

namespace Application\Controller;

use Application\Controller\DbController;

class DoctorDbController extends DbController {

    public function indexAction() {
        $params = $this->getParams();
        try {
            $doctor = $this->doctorModel()->get($params);
            $doctorJson = $doctor ? $doctor->toArray(true) : [];
            $json = $this->generateJSONViewModel(0, '', $doctorJson);
        } catch (Exception $ex) {
            $json = $this->generateJSONViewModel(1, $ex->getMessage(), null);
        }
        return $json;
    }
    
    public function allAction() {
        try {
            $doctors = $this->doctorModel()->getAll();
            $doctorsJson = [];
            foreach($doctors as $doctor) {
                $json = $doctor->toArray();
                array_push($doctorsJson, $json);
            }
            $json = $this->generateJSONViewModel(0, '', $doctorsJson);
        } catch (Exception $ex) {
            $json = $this->generateJSONViewModel(1, $ex->getMessage(), null);
        }
        return $json;
    }
    
}
