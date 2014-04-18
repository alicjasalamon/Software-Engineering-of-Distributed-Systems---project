<?php

namespace Application\Controller;

use Application\Controller\DbController;
use Application\Utilities\Validators\InstitutionValidator;
use Application\Utilities\Exceptions\InvalidParameterException;

class InstitutionDbController extends DbController {
    
    /**
     * @var InstitutionValidator
     */
    protected $validator;
    
    public function __construct() {
        $this->validator = new InstitutionValidator();
    }
    
    public function indexAction() {
        $params = $this->getParams();
        try{
            $this->validator->validateGet($params);
            $institution = $this->model()->institutionModel()->get($params);
            $institutionJson = $institution ? $institution->toArray() : [];
            $json = $this->generateJSONViewModel(0, '', $institutionJson);
        } catch (Exception $ex) {
            $json = $this->generateFailedJSONViewModel($ex);
        }
        return $json;
    }
    
    public function allAction() {
        try {
            $institutions = $this->model()->institutionModel()->getAll();
            $institutionsJson = [];
            foreach($institutions as $institution) {
                $json = $institution->toArray();
                array_push($institutionsJson, $json);
            }
            $json = $this->generateJSONViewModel(0, '', $institutionsJson);
        } catch (Exception $ex) {
            $json = $this->generateFailedJSONViewModel($ex);
        }
        return $json;
    }
    
    public function addAction() {
        $params = $this->getParams();
        try {
            $this->validator->validateAdd($params);
            $institution = $this->model()->institutionModel()->add($params);
            $institutionJson = $institution ? $institution->toArray() : [];
            $json = $this->generateJSONViewModel(0, '', $institutionJson);
        } catch (InvalidParameterException $ex) {
            $json = $this->generateInvalidParamsJSONViewModel($ex);
        } catch (Exception $ex) {
            $json = $this->generateFailedJSONViewModel($ex);
        }
        return $json;
    }
    
}
