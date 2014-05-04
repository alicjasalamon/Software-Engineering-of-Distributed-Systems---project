<?php

namespace Application\Auth;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Application\Model\Model;

class AuthAdapter implements AdapterInterface {
    
    protected $login;
    protected $password;
    
    /**
     * @var Model;
     */
    protected $model;
    
    public function setUsername($username) {
        $this->login = $username;
    }
    
    public function setPassword($password) {
        $this->password = $password;
    }
    
    public function setModel(Model $model) {
        $this->model = $model;
    }

    public function authenticate() {
        $user = $this->model->userModel()->authenticate($this->login, $this->password);
        $code = $user ? Result::SUCCESS : Result::FAILURE;
        $subUser = $user ? $this->model->userModel()->getSubUser($user) : null;
        $identity = $user ? new AuthIdentity(
                $user->getLogin(), 
                $user->getGroup(),
                $subUser) : null;
        return new Result($code, $identity);
    }


}
