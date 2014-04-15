<?php

namespace Application\Model;

use Application\Model\EntityModel;

class ScheduleModel extends EntityModel {
    
    public function get($params) {
        $schedule = $this->scheduleRepository()->findById($params['id']);
        return $schedule;
    }
    
    public function clear() {
        $this->scheduleRepository()->remove();
    }
    
}
