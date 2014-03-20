<?php

namespace Application\Controller;
use Application\Controller\DbController;

class InstitutionController extends DbController {
   
    protected $institutionModel;
    
    public function indexAction() {
        $params = $this->getParams();
        try{
            $institutionJson = $this->institutionModel()->getAction($params);
            $json = $this->generateJSONViewModel(0, '', $institutionJson);
        } catch (Exception $ex) {
            $json = $this->generateJSONViewModel(1, $ex->getMessage(), null);
        }
        return $json;
    }
    
    public function addAction() {
        $params = $this->getParams();
        try {
            $institutionJson = $this->institutionModel()->addAction($params);
            $json = $this->generateJSONViewModel(0, '', $institutionJson);
        } catch (Exception $ex) {
            $json = $this->generateJSONViewModel(1, $ex->getMessage(), null);
        }
        return $json;
    }
    
    public function allAction() {
        try {
            $institutionJson = $this->institutionModel()->allAction();
            $json = $this->generateJSONViewModel(0, '', $institutionJson);
        } catch (Exception $ex) {
            $json = $this->generateJSONViewModel(1, $ex->getMessage(), null);
        }
        return $json;
    }
    
}
