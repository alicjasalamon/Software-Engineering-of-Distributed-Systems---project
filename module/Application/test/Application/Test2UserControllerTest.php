<?php

require_once 'ControllerTestCase.php';

class Test2UserControllerTest extends ControllerTestCase {
    
    public function testAddDoctor() {
        return;
        $addedJson = $this->addDoctor();
        $getJson = $this->getDoctor($addedJson->data->id);
        $this->assertEquals($getJson, $addedJson);
        ControllerTestCase::$doctor = $addedJson;
    }
    
    public function testAddPatient() {
        return;
        $addedJson = $this->addPatient();
        $getJson = $this->getPatient($addedJson->data->id);
        $this->assertEquals($getJson, $addedJson);
        ControllerTestCase::$patient = $addedJson;
    }
    
    protected function addDoctor() {
        $insertData = [
            'login' => 'testdoctor',
            'password' => '12341234',
            'group' => 'doctor',
            'institution' => ControllerTestCase::$institution->data->id,
            'firstname' => 'Test',
            'lastname' => 'Doctor',
            'email' => 'test@email.com',
        ];
        $this->dispatch('/db/user/add', 'POST', $insertData);
        $this->assertResponseStatusCode(200);
        $addedDoctor = $this->getResponseAsArray();
        return $addedDoctor;
    }
    
    protected function getDoctor($id) {
        $getData = [
            'id' => $id,
        ];
        $this->dispatch('/db/doctor', 'POST', $getData);
        $this->assertResponseStatusCode(200);
        $getJson = $this->getResponseAsArray();
        return $getJson;
    }
    
    protected function addPatient() {
        $insertData = [
            'login' => 'testpatient',
            'password' => '12341234',
            'group' => 'patient',
            'institution' => ControllerTestCase::$institution->data->id,
            'doctor' => ControllerTestCase::$doctor->data->id,
            'firstname' => 'Test',
            'lastname' => 'Patient',
            'email' => 'test@email.com',
        ];
        $this->dispatch('/db/user/add', 'POST', $insertData);
        $this->assertResponseStatusCode(200);
        $addedPatient = $this->getResponseAsArray();
        return $addedPatient;
    }
    
    protected function getPatient($id) {
        $getData = [
            'id' => $id,
        ];
        $this->dispatch('/db/patient', 'POST', $getData);
        $this->assertResponseStatusCode(200);
        $getJson = $this->getResponseAsArray();
        return $getJson;
    }
    
}
