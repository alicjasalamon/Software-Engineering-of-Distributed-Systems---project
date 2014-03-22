<?php

namespace Application\Controller;

class LoginController extends BaseController
{

    public function indexAction() {
        return new ViewModel();
    }
    
    public function loginAction() {
        return $this->generateJSONViewModel($code, $message, $data);
    }
    
    public function logoutAction() {
        return $this->generateJSONViewModel($code, $message, $data);        
    }

}

