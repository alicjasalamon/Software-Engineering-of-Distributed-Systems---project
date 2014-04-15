<?php

require_once 'ControllerTestCase.php';

class Test1InstitutionControllerTest extends ControllerTestCase {
    
    public function testAddInstitution() {
        return;
        $addedJson = $this->addInstitution();
        $getJson = $this->getInstitution($addedJson->data->id);
        $this->assertEquals($getJson, $addedJson);
        $this->assertEquals($getJson->data->name, 'Placowka testowa');
        ControllerTestCase::$institution = $addedJson;
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
    
    protected function getInstitution($id) {
        $getData = [
            'id' => $id,
        ];
        $this->dispatch('/db/institution', 'POST', $getData);
        $this->assertResponseStatusCode(200);
        $getJson = $this->getResponseAsArray();
        return $getJson;
    }
    
}
