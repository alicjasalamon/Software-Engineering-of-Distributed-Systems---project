<?php

namespace Application\Controller;

class DayDbController extends DbController
{

    public function indexAction() {
        $params = $this->getParams();
        try {
            $day = $this->patientModel()->getDay($params);
            $dayJson = $day ? $day->toArray(true) : [];
            $json = $this->generateJSONViewModel(0, '', $dayJson);
        } catch (Exception $ex) {
            $json = $this->generateJSONViewModel(1, $ex->getMessage(), null);
        }
        return $json;
    }

}

