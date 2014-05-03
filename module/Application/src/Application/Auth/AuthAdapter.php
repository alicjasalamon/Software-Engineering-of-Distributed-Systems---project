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
        $result = $this->model->userModel()->authenticate($this->login, $this->password);
        $code = $result ? Result::SUCCESS : Result::FAILURE;
        $identity = $result ? new AuthIdentity($result->getLogin(), $result->getGroup(), $result->getLogin()) : null;
        return new Result($code, $identity);
    }

}
