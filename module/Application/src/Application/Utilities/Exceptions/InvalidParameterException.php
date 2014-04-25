<?php

namespace Application\Utilities\Exceptions;

class InvalidParameterException extends \Exception {
    
    protected $message;
    
    public function __construct($message = 'unknown', $value) {
        $this->message = 'Invalid parameter: ' . $message;
        if($value !== NULL) {
            $this->message .= ' = ' . $value;
        }
    }
    
    public function toString() {
        return $this->getMessage();
    }
        
}
