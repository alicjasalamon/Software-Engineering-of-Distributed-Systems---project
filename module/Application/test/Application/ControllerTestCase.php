<?php

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Zend\Json\Json;

class ControllerTestCase extends AbstractHttpControllerTestCase {
    
    protected $traceError = true;
    
    public function setUp() {
        $this->setApplicationConfig(
            include 'C:\xampp\htdocs\IOSR\config\application.config.php'
        );
        parent::setUp();
    }
    
    protected function getInstitutionId() {
        $this->dispatch('/db/institution/all', 'POST', []);
        $this->assertResponseStatusCode(200);
        $institutions = $this->getResponseAsArray();
        $firstInstitution = $institutions->data[0];
        $firstInstitutionId = $firstInstitution->id;
        return $firstInstitutionId;
    }
    
    protected function getDoctorId() {
        $this->dispatch('/db/doctor/all', 'POST', []);
        $this->assertResponseStatusCode(200);
        $doctors = $this->getResponseAsArray();
        $firstDoctor = $doctors->data[0];
        $firstDoctorId = $firstDoctor->id;
        return $firstDoctorId;
    }
    
    protected function getPatientId() {
        $this->dispatch('/db/patient/all', 'POST', []);
        $this->assertResponseStatusCode(200);
        $patients = $this->getResponseAsArray();
        $firstPatient = $patients->data[0];
        $firstPatientId = $firstPatient->id;
        return $firstPatientId;
    }
    
    protected function getResponseAsArray() {
        $response = $this->getResponse();
        $content = $response->getContent();
        $json = Json::decode($content);
        return $json;
    }
    
}
