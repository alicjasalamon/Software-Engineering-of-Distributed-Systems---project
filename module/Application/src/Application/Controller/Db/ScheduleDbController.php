<?php

namespace Application\Controller\Db;

use Application\Utilities\Validators\ScheduleValidator;

class ScheduleDbController extends DbController {
    
    /**
     * @var ScheduleValidator
     */
    protected $validator;
    
    public function __construct() {
        $this->validator = new ScheduleValidator();
    }
    
    public function indexAction() {
        return $this->wrapSingleResultAction(function($params){
            $this->validator->validateGet($params);
            $schedule = $this->model()->scheduleModel()->get($params);
            return $schedule;
        });
    }
    
}
