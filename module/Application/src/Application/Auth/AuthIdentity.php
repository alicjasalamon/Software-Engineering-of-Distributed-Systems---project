<?php

namespace Application\Auth;

class AuthIdentity {
    
    protected $login;
    protected $group;
    protected $name;
    protected $id;
    
    public function __construct($login, $group, $subUser) {
        $this->login = $login;
        $this->group = $group;
        $this->name = $subUser->getFirstname() . ' ' . $subUser->getLastname();
        $this->id = (string) $subUser->getId();
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
    
    public function getId() {
        return $this->id;
    }
    
}
