<?php

namespace Application\Controller\Db;

use Application\Utilities\Validators\MeasurementsValidator;

class MeasurementsDbController extends DbController {
    
    /**
     * @var InstitutionValidator
     */
    protected $validator;
    
    public function __construct() {
        $this->validator = new MeasurementsValidator();
    }
    
    public function indexAction() {
        return $this->wrapSingleResultAction(function($params) {
            $this->validator->validateGet($params);
            $institution = $this->model()->measurementsModel()->get($params);
            return $institution;
        });
    }
    
}
