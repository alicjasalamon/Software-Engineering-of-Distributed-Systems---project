<?php

namespace Application\Controller;
use Application\Controller\DbController;

class InstitutionController extends DbController {
    
    public function indexAction() {
        $params = $this->getParams();
        try{
            $institutionJson = $this->institutionModel()->get($params);
            $json = $this->generateJSONViewModel(0, '', $institutionJson);
        } catch (Exception $ex) {
            $json = $this->generateJSONViewModel(1, $ex->getMessage(), null);
        }
        return $json;
    }
    
    public function allAction() {
        try {
            $institutionsJson = $this->institutionModel()->getAll();
            $json = $this->generateJSONViewModel(0, '', $institutionsJson);
        } catch (Exception $ex) {
            $json = $this->generateJSONViewModel(1, $ex->getMessage(), null);
        }
        return $json;
    }
    
    public function addAction() {
        $params = $this->getParams();
        try {
            $institutionJson = $this->institutionModel()->add($params);
            $json = $this->generateJSONViewModel(0, '', $institutionJson);
        } catch (Exception $ex) {
            $json = $this->generateJSONViewModel(1, $ex->getMessage(), null);
        }
        return $json;
    }
    
}
