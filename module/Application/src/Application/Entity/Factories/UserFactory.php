<?php

namespace Application\Entity\Factories;

use Application\Entity\User;
use Application\Entity\UserQuery;
use Application\Entity\UserRepository;

class UserFactory {
    
    private $_mandango;
    
    public function __construct($mandango) {
        $this->_mandango = $mandango;
    }
    
    public function createAndPersist($params) {
        $name = $params['name'];
        $user = $this->_mandango->create('Application\Entity\User', array($name));
        $this->_mandango->persist($user);
        $this->_mandango->flush();
        return $user;
    }
    
    public function create($name){
        $user = new User($name);
        return $user;
    }
    
}
