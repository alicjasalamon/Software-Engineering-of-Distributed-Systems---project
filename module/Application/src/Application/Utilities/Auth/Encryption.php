<?php

namespace Application\Utilities\Auth;

class Encryption {
    
    public function encrypt($text) {
        $encrypted = sha1($text);
        return $encrypted;
    }
    
}
