<?php

require_once 'ControllerTestCase.php';

class Test0ControllerTest extends ControllerTestCase {
    
    public function testCase1() {
        $institution1 = $this->addInstitution();
        
        $doctor1 = $this->addDoctor($institution1);
        $doctor2 = $this->addDoctor($institution1);
                
        $patient1 = $this->addPatient($institution1, $doctor1);
        $patient2 = $this->addPatient($institution1, $doctor1);
        $patient3 = $this->addPatient($institution1, $doctor2);
        $patient4 = $this->addPatient($institution1, $doctor2);
        
        $date1 = '20140418';
        $date2 = '20140419';
        
        $event1 = $this->addEvent($patient1, $date1, '08:00');
        $event2 = $this->addEvent($patient1, $date1, '10:00');
        $event3 = $this->addEvent($patient1, $date1, '14:00');
        $event4 = $this->addEvent($patient1, $date2, '18:00');
        $event5 = $this->addEvent($patient1, $date2, '20:00');
        
        $this->assertEventInDay($patient1, $date1, $event1);
        $this->getDay($patient1, $date1);
        $this->assertEventInDay($patient1, $date1, $event1);
        $this->getDay($patient1, $date1);
        $this->assertEventInDay($patient1, $date1, $event1);
        $this->assertEventInDay($patient1, $date1, $event2);
        $this->assertEventInDay($patient1, $date1, $event3);
        $this->assertEventInDay($patient1, $date2, $event4);
        $this->assertEventInDay($patient1, $date2, $event5);
        
        $this->success();
    }
    
    protected function addInstitution() {
        $insertData = [
            'name' => $this->getRandomString('Placowka testowa'),
        ];
        $this->dispatch('/db/institution/add', 'POST', $insertData);
        $this->assertResponseStatusCode(200);
        $addedJson = $this->getResponseAsArray();
        return $addedJson;
    }
    
    protected function addDoctor($institution) {
        $insertData = [
            'login' => $this->getRandomString('testdoctor'),
            'password' => '12341234',
            'group' => 'doctor',
            'institution' => $institution->data->id,
            'firstname' => $this->getRandomString('John'),
            'lastname' => $this->getRandomString('Doctor'),
            'email' => 'test@email.com',
        ];
        $this->dispatch('/db/user/add', 'POST', $insertData);
        $this->assertResponseStatusCode(200);
        $addedDoctor = $this->getResponseAsArray();
        return $addedDoctor;
    }
    
    protected function addPatient($institution, $doctor) {
        $insertData = [
            'login' => $this->getRandomString('testpatient'),
            'password' => '12341234',
            'group' => 'patient',
            'institution' => $institution->data->id,
            'doctor' => $doctor->data->id,
            'firstname' => $this->getRandomString('John'),
            'lastname' => $this->getRandomString('Patient'),
            'email' => $this->getRandomString() . '@email.com',
        ];
        $this->dispatch('/db/user/add', 'POST', $insertData);
        $this->assertResponseStatusCode(200);
        $addedPatient = $this->getResponseAsArray();
        return $addedPatient;
    }
    
    protected function addEvent($patient, $date, $time) {
        $insertData = [
            'patientid' => $patient->data->id,
            'date' => $date,
            'activity' => 'diet',
            'title' => $this->getRandomString(),
            'details' => $this->getRandomString(),
            'time' => $time,
            'duration' => 60,
        ];
        $this->dispatch('/db/event/add', 'POST', $insertData);
        $this->assertResponseStatusCode(200);
        $addedEvent = $this->getResponseAsArray();
        return $addedEvent;
    }
    
    protected function getDay($patient, $date) {
        $getData = [
            'patientid' => $patient->data->id,
            'date' => $date,
        ];
        $this->dispatch('/db/day', 'POST', $getData);
        $this->assertResponseStatusCode(200);
        $getJson = $this->getResponseAsArray();
        return $getJson;
    }
    
    protected function assertEventInDay($patient, $date, $event) {
        $getJson = $this->getDay($patient, $date);
        $this->assertEquals($date, $getJson->data->date);
        //$this->assertEmpty($getJson->data->streams);
        
        $eventTime = $event->data->time;
        $found = false;
        foreach ($getJson->data->streams as $stream) {
            if($found) break;
            foreach($stream->events as $event) {
                $found = $event->time == $eventTime;
                if($found) {
                    break;
                }
            }
        }
        
        $this->assertTrue($found);
    }
    
}
