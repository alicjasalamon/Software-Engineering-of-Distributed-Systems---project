<?php

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Zend\Json\Json;

class ControllerTestCase extends AbstractHttpControllerTestCase {
    
    /*
     * @var Application\Entity\Institution
     */
    protected static $institution;
    
    /*
     * @var Application\Entity\Doctor
     */
    protected static $doctor;
    
    /*
     * @var Application\Entity\Patient
     */
    protected static $patient;
    
    /*
     * @var Application\Entity\Event
     */
    protected static $event;

    protected $traceError = true;
    protected $config = [
        'date' => '20140413',
    ];
    
    public function setUp() {
        $this->setApplicationConfig(
            include 'C:\xampp\htdocs\IOSR\config\application.config.php'
        );
        parent::setUp();
    }
    
    protected function getResponseAsArray() {
        $response = $this->getResponse();
        $content = $response->getContent();
        $json = Json::decode($content);
        return $json;
    }
    
    protected function getRandomString($prefix = null) {
        $generated = substr(rtrim(base64_encode(md5(microtime())),"="), 0, 6);
        return $prefix ? "$prefix$generated" : $generated;
    }
    
    protected function success() {
        print "\n";
        print "=====================================\n";
        print "=== All tests passed successfully ===\n";
        print "=====================================\n";
    }
    
}
