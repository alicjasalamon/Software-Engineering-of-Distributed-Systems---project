<?php

namespace Application\Controller\Db;

use Application\Utilities\Validators\ScheduleValidator;
use Application\Utilities\Exceptions\InvalidParameterException;

class ScheduleDbController extends DbController {
    
    /**
     * @var ScheduleValidator
     */
    protected $validator;
    
    public function __construct() {
        $this->validator = new ScheduleValidator();
    }
    
    public function indexAction() {
        $params = $this->getParams();
        try {
            $this->validator->validateGet($params);
            $schedule = $this->model()->scheduleModel()->get($params);
            $scheduleJson = $schedule ? $schedule->toArray(true) : [];
            $json = $this->generateDataJSONViewModel($scheduleJson);
        } catch (InvalidParameterException $ex) {
            $json = $this->generateInvalidParamsJSONViewModel($ex);
        } catch (Exception $ex) {
            $json = $this->generateFailedJSONViewModel($ex);
        }
        return $json;
    }
    
}
