<?php

namespace Application\Auth;

class AuthIdentity {
    
    protected $login;
    protected $group;
    protected $name;
    
    public function __construct($login, $group, $name) {
        $this->login = $login;
        $this->group = $group;
        $this->name = $name;
    }
    
    public function getLogin() {
        return $this->login;
    }
    
    public function getGroup() {
        return $this->group;
    }
    
    public function getName() {
        return $this->name;
    }
    
}
