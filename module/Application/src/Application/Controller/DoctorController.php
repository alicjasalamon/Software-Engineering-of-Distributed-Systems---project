<?php

namespace Application\Controller;
use Application\Controller\DbController;
use Application\Model;

class DoctorController extends DbController {

    public function indexAction() {
        $params = $this->getParams();
        try{
            $doctorJson = $this->doctorModel()->getAction($params);
            $json = $this->generateJSONViewModel(0, '', $doctorJson);
        } catch (Exception $ex) {
            $json = $this->generateJSONViewModel(1, $ex->getMessage(), null);
        }
        return $json;
    }
    
    public function addAction() {
        $params = $this->getParams();
        try {
            $doctorJson = $this->doctorModel()->addAction($params);
            $json = $this->generateJSONViewModel(0, '', $doctorJson);
        } catch (Exception $ex) {
            $json = $this->generateJSONViewModel(1, $ex->getMessage(), null);
        }
        return $json;
    }
    
    public function setInstitutionAction() {
        $params = $this->getParams();
        try {
            $doctorJson = $this->doctorModel()->updateInstitutionAction($params);
            $json = $this->generateJSONViewModel(0, '', $doctorJson);
        } catch (Exception $ex) {
            $json = $this->generateJSONViewModel(1, $ex->getMessage(), null);
        }
        return $json;
    }
    
}
