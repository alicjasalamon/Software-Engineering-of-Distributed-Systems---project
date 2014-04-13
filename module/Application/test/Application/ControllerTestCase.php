<?php

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class ControllerTestCase extends AbstractHttpControllerTestCase {
    
    protected $traceError = true;
    
    public function setUp() {
        $this->setApplicationConfig(
            include 'C:\xampp\htdocs\IOSR\config\application.config.php'
        );
        parent::setUp();
    }
    
}

