<?php

require_once 'ControllerTestCase.php';

use Zend\Json\Json;

class InstitutionControllerTest extends ControllerTestCase {
    
    public function testAddInstitution() {
        $addedJson = $this->addInstitution();
        $getJson = $this->getInstitution($addedJson->data->id);
        $this->assertEquals($getJson, $addedJson);
        $this->assertEquals($getJson->data->name, 'Placowka testowa');
    }
    
    protected function addInstitution() {
        $insertData = [
            'name' => 'Placowka testowa',
        ];
        $this->dispatch('/db/institution/add', 'POST', $insertData);
        $this->assertResponseStatusCode(200);
        $addedInstitutionJson = $this->getResponse()->getContent();
        $addedJson = Json::decode($addedInstitutionJson);
        return $addedJson;
    }
    
    protected function getInstitution($id) {
        $getData = [
            'id' => $id,
        ];
        $this->dispatch('/db/institution', 'POST', $getData);
        $this->assertResponseStatusCode(200);
        $getInstitutionJson = $this->getResponse()->getContent();
        $getJson = Json::decode($getInstitutionJson);
        return $getJson;
    }
    
}
