<?php

namespace Application\Utilities\Exceptions;

class InvalidParameterException extends \Exception {
    
    protected $message;
    
    public function __construct($message = 'unknown') {
        $this->message = 'Invalid parameter: ' . $message;
    }
    
    public function toString() {
        return $this->getMessage();
    }
        
}
