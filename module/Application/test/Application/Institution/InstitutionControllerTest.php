<?php

namespace Test\InstitutionTest;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Zend\Json\Json;

class InstitutionControllerTest extends AbstractHttpControllerTestCase {
    
    /*
     * @var InstitutionTest
     */
    protected $institutionTest;
    protected $traceError = true;
    
    public function setUp() {
        $this->setApplicationConfig(
            include 'C:\xampp\htdocs\IOSR\config\application.config.php'
        );
        parent::setUp();
        $this->institutionTest = new InstitutionTest();
    }
    
    public function testAddInstitution() {
        $postData = [
            'name' => 'Placowka testowa',
        ];
        $this->dispatch('/db/institution/add', 'POST', $postData);
        $this->assertResponseStatusCode(200);
        
        $institutionJson = $this->getResponse()->getContent();
        $json = Json::decode($institutionJson, Json::TYPE_OBJECT);
        
        $institution = $json->data;
        $institutionId = $institution->id;
        print_r($institutionId);
    }

    /*
    public function testIndexActionCanBeAccessed() {
        $this->dispatch('/db/institution');
        $this->assertResponseStatusCode(200);
        
        $this->assertModuleName('Institution');
        $this->assertControllerName('Application\Controller\Institution');
        $this->assertControllerClass('InstitutionController');
        $this->assertMatchedRouteName('institution');
    }
    */
}
