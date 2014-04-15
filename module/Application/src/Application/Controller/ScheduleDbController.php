<?php

namespace Application\Controller;

class ScheduleDbController extends DbController {
    
    public function indexAction() {
        $params = $this->getParams();
        try {
            $schedule = $this->scheduleModel()->get($params);
            $scheduleJson = $schedule ? $schedule->toArray(true) : [];
            $json = $this->generateJSONViewModel(0, '', $scheduleJson);
        } catch (Exception $ex) {
            $json = $this->generateJSONViewModel(1, $ex->getMessage(), null);
        }
        return $json;
    }
    
}
