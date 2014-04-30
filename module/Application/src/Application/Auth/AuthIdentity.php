<?php

namespace Application\Auth;

class AuthIdentity {
    
    protected $login;
    protected $group;
    
    public function __construct($login, $group) {
        $this->login = $login;
        $this->group = $group;
    }
    
    public function getLogin() {
        return $this->login;
    }
    
    public function getGroup() {
        return $this->group;
    }
    
}
