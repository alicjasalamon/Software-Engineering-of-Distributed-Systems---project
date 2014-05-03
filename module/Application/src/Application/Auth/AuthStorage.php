<?php

namespace Application\Auth;

use Zend\Authentication\Storage\Session;

class AuthStorage extends Session {
    
    public function setRememberMe($rememberMe = 0, $time = 86400) {
        if($rememberMe == 1) {
            $this->session->getManager()->rememberMe($time);
        }
    }
    
    public function forgetMe() {
        $this->session->getManager()->forgetMe();
    }
    
}
