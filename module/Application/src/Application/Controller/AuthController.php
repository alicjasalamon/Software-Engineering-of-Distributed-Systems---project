<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Application\Auth\AuthStorage;

class AuthController extends BaseController {

    /**
     *
     * @var AuthStorage
     */
    protected $storage;
    
    public function indexAction() {
        $this->attemptRedirect();
        return new ViewModel();
    }
    
    public function loginAction() {
        $this->attemptRedirect();
        $params = $this->getParams();
        $authAdapter = $this->getAuth()->getAdapter();
        $authAdapter->setModel($this->model());
        $authAdapter->setUsername($params['login']);
        $authAdapter->setPassword($params['password']);
        $result = $this->getAuth()->authenticate();
        if($result->isValid()) {
            $this->attemptRedirect();
        } else {
            $this->redirect()->toRoute('auth');
        }
    }
    
    public function logoutAction() {
        $this->getAuth()->clearIdentity();
        $this->redirect()->toRoute('auth');
    }
    
    protected function getSessionStorage() {
        if(!$this->storage) {
            $this->storage = $this->getServiceLocator()->get('AuthStorage');
        }         
        return $this->storage;
    }

    protected function attemptRedirect() {
        if($this->getAuth()->hasIdentity()) {
            $identity = $this->getAuth()->getIdentity();
            $route = $this->getRedirectRoute($identity->getGroup());
            $this->redirect()->toRoute($route);
        }
    }

    private function getRedirectRoute($group) {
        $array = [
            'doctor'    => 'schedule',
            'patient'   => 'schedule',
            'admin'     => 'admin',
        ];
        return $array[$group];
    }
    
}

