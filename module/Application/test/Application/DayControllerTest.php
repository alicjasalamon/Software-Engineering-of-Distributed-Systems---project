<?php

require_once 'ControllerTestCase.php';

class DayControllerTest extends ControllerTestCase {

    public function testGetDay() {
        $getJson = $this->getDay();
        $this->assertEquals($getJson->data->date, '20140413');
        $this->assertEmpty($getJson->data->streams);
        print_r($getJson);
    }

    protected function getDay() {
        $getData = [
            'patientid' => $this->getPatientId(),
            'date' => '20140413',
        ];
        $this->dispatch('/db/day', 'POST', $getData);
        $this->assertResponseStatusCode(200);
        $getJson = $this->getResponseAsArray();
        return $getJson;
    }

}
