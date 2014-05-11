<?php

namespace Application\Controller\Db;

use Application\Utilities\Validators\InstitutionValidator;

class MeasurementsDbController extends DbController {
    
    /**
     * @var InstitutionValidator
     */
    protected $validator;
    
    public function __construct() {
        $this->validator = new InstitutionValidator();
    }
    
    public function indexAction() {
        return $this->wrapSingleResultAction(function($params) {
            $this->validator->validateGet($params);
            $institution = $this->model()->institutionModel()->get($params);
            return $institution;
        });
    }
    
    public function allAction() {
        return $this->wrapMultipleResultsAction(function($params) {
            $institutions = $this->model()->institutionModel()->getAll();
            return $institutions;
        });
    }
    
    public function addAction() {
        return $this->wrapSingleResultAction(function($params) {
            $this->validator->validateAdd($params);
            $institution = $this->model()->institutionModel()->add($params);
            return $institution;
        });
    }
    
}
