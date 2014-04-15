<?php

require_once 'ControllerTestCase.php';

class Test3EventControllerTest extends ControllerTestCase {
    
    public function testAddEvent() {
        return;
        $addedJson = $this->addEvent();
        ControllerTestCase::$event = $addedJson;
    }
    
    protected function addEvent() {
        $insertData = [
            'patientid' => ControllerTestCase::$patient->data->id,
            'date' => $this->config['date'],
            'activity' => 'diet',
            'title' => 'test',
            'details' => 'asdasdad',
            'time' => '12:00',
            'duration' => 60,
        ];
        $this->dispatch('/db/event/add', 'POST', $insertData);
        $this->assertResponseStatusCode(200);
        $addedEvent = $this->getResponseAsArray();
        return $addedEvent;
    }
      
    
}
