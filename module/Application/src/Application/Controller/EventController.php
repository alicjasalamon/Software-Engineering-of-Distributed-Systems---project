<?php

namespace Application\Controller;

class EventController extends DbController {
    
    public function addAction() {
        $params = $this->getParams();
        try {
            $event = $this->patientModel()->addEvent($params);
            $eventJson = $event ? $event->toArray(true) : [];
            $json = $this->generateJSONViewModel(0, '', $eventJson);
        } catch (Exception $ex) {
            $json = $this->generateJSONViewModel(1, $ex->getMessage(), null);
        }
        return $json;
    }

}

