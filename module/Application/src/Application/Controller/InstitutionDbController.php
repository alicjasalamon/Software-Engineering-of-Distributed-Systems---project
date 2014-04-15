<?php

namespace Application\Controller;

use Application\Controller\DbController;

class InstitutionDbController extends DbController {
    
    public function indexAction() {
        $params = $this->getParams();
        try{
            $institution = $this->institutionModel()->get($params);
            $institutionJson = $institution ? $institution->toArray() : [];
            $json = $this->generateJSONViewModel(0, '', $institutionJson);
        } catch (Exception $ex) {
            $json = $this->generateJSONViewModel(1, $ex->getMessage(), null);
        }
        return $json;
    }
    
    public function allAction() {
        try {
            $institutions = $this->institutionModel()->getAll();
            $institutionsJson = [];
            foreach($institutions as $institution) {
                $json = $institution->toArray();
                array_push($institutionsJson, $json);
            }
            $json = $this->generateJSONViewModel(0, '', $institutionsJson);
        } catch (Exception $ex) {
            $json = $this->generateJSONViewModel(1, $ex->getMessage(), null);
        }
        return $json;
    }
    
    public function addAction() {
        $params = $this->getParams();
        try {
            $institution = $this->institutionModel()->add($params);
            $institutionJson = $institution ? $institution->toArray() : [];
            $json = $this->generateJSONViewModel(0, '', $institutionJson);
        } catch (Exception $ex) {
            $json = $this->generateJSONViewModel(1, $ex->getMessage(), null);
        }
        return $json;
    }
    
}
