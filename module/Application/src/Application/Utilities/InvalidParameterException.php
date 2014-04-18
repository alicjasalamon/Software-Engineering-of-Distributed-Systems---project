<?php

namespace Application\Utilities;

class InvalidParameterException extends \Exception {
    
    protected $message;
    
    public function __construct($message = 'unknown') {
        $this->message = 'Invalid parameter: ' . $message;
    }
    
    public function __toString() {
        return $this->getMessage();
    }
        
}
