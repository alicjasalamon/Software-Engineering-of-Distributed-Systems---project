<?php

namespace Application\Controller\Db;

use Application\Utilities\Validators\DayValidator;

class DayDbController extends DbController
{
    /*
     * @var DayValidator
     */
    protected $validator;
    
    public function __construct() {
        $this->validator = new DayValidator();
    }

    public function indexAction() {
        return $this->wrapSingleResultAction(function ($params) {
            $this->validator->validateGet($params);
            $day = $this->model()->patientModel()->getDay($params);
            return $day;
        });
    }

}

