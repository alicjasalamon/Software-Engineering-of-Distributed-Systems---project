<?php

require_once 'ControllerTestCase.php';

class Test0ControllerTest extends ControllerTestCase {
    
    public function testCase1() {
        $institution = $this->addInstitution();
        $doctor = $this->addDoctor($institution);
        $patient = $this->addPatient($institution, $doctor);
        $event = $this->addEvent($patient);
        
        $day = $this->getDay($patient);
        $this->assertEventInDay($patient, $event);
    }
    
    protected function addInstitution() {
        $insertData = [
            'name' => 'Placowka testowa',
        ];
        $this->dispatch('/db/institution/add', 'POST', $insertData);
        $this->assertResponseStatusCode(200);
        $addedJson = $this->getResponseAsArray();
        return $addedJson;
    }
    
    protected function addDoctor($institution) {
        $insertData = [
            'login' => 'testdoctor',
            'password' => '12341234',
            'group' => 'doctor',
            'institution' => $institution->data->id,
            'firstname' => 'Test',
            'lastname' => 'Doctor',
            'email' => 'test@email.com',
        ];
        $this->dispatch('/db/user/add', 'POST', $insertData);
        $this->assertResponseStatusCode(200);
        $addedDoctor = $this->getResponseAsArray();
        return $addedDoctor;
    }
    
    protected function addPatient($institution, $doctor) {
        $insertData = [
            'login' => 'testpatient',
            'password' => '12341234',
            'group' => 'patient',
            'institution' => $institution->data->id,
            'doctor' => $doctor->data->id,
            'firstname' => 'Test',
            'lastname' => 'Patient',
            'email' => 'test@email.com',
        ];
        $this->dispatch('/db/user/add', 'POST', $insertData);
        $this->assertResponseStatusCode(200);
        $addedPatient = $this->getResponseAsArray();
        return $addedPatient;
    }
    
    protected function addEvent($patient) {
        $insertData = [
            'patientid' => $patient->data->id,
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
    
    protected function getDay($patient) {
        $getData = [
            'patientid' => $patient->data->id,
            'date' => $this->config['date'],
        ];
        $this->dispatch('/db/day', 'POST', $getData);
        $this->assertResponseStatusCode(200);
        $getJson = $this->getResponseAsArray();
        return $getJson;
    }
    
    protected function assertEventInDay($patient, $event) {
        $getJson = $this->getDay($patient);
        $this->assertEquals($this->config['date'], $getJson->data->date);
        //$this->assertEmpty($getJson->data->streams);
        
        $eventTime = $event->data->time;
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
    
}
