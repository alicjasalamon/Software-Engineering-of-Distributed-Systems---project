<?php

namespace Application\Controller\Db;

use Application\Utilities\Validators\DoctorValidator;

class DoctorDbController extends DbController {

    /**
     * @var DoctorValidator
     */
    protected $validator;
    
    public function __construct() {
        $this->validator = new DoctorValidator();
    }
    
    public function indexAction() {
        return $this->wrapSingleResultAction(function ($params) {
            $this->validator->validateGet($params);
            $doctor = $this->model()->doctorModel()->get($params);
            return $doctor;
        });
    }
    
    public function allAction() {
        return $this->wrapMultipleResultsAction(function ($params) {
            $doctors = $this->model()->doctorModel()->getAll();
            return $doctors;
        });
    }
    
}
