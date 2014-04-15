<?php

require_once 'ControllerTestCase.php';

class Test4DayControllerTest extends ControllerTestCase {

    public function testGetDay() {
        return;
        $getJson = $this->getDay();
        $this->assertEquals($getJson->data->date, $this->config['date']);
        $this->assertEmpty($getJson->data->streams);
        
        $eventTime = ControllerTestCase::$event->data->id;
        $found = false;
        foreach ($getJson->data->streams as $stream) {
            if($found) break;
            foreach($stream->events as $event) {
                $found = $event->time == $eventTime;
                if($found) break;
            }
        }
        $this->assertTrue($found);
    }

    protected function getDay() {
        $getData = [
            'patientid' => ControllerTestCase::$patient->data->id,
            'date' => $this->config['date'],
        ];
        $this->dispatch('/db/day', 'POST', $getData);
        $this->assertResponseStatusCode(200);
        $getJson = $this->getResponseAsArray();
        return $getJson;
    }

}
