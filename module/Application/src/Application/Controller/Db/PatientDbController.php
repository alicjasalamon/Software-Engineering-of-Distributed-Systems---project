<?php

namespace Application\Controller\Db;

use Application\Utilities\Validators\PatientValidator;

class PatientDbController extends DbController {
    
    /**
     * @var PatientValidator;
     */
    protected $validator;
    
    public function __construct() {
        $this->validator = new PatientValidator();
    }
    
    public function indexAction() {
        $this->wrapSingleResultAction(function($params) {
            $this->validator->validateGet($params);
            $patient = $this->model()->patientModel()->get($params);
            return $patient;
        });
    }
    
    public function allAction() {
        $this->wrapMultipleResultsAction(function($params) {
            $patients = $this->model()->patientModel()->getAll();
            return $patients;
        });
    }
    
}
