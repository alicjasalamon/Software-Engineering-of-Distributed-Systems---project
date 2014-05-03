<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Authentication\AuthenticationServiceInterface;
use Application\Model\Model;

abstract class BaseController extends AbstractActionController {
            
    /**
     * @var AuthenticationServiceInterface
     */
    private $auth;
    
    /**
     * @var Model;
     */
    private $model;
    
    protected function mandango() {
        return $this->getServiceLocator()->get('mandango');
    }
    
    /**
     * @var Model
     */
    protected function model() {
        if(!$this->model) {
            $this->model = new Model($this->mandango());
        }
        return $this->model;
    }
    
    protected function getAuth() {
        if(!$this->auth) {
            $this->auth = $this->getServiceLocator()->get('Auth');
        }         
        return $this->auth;
    }
    
    protected function requireAuth($group = null) {
        return;
        $redirect = $group == null;
        if(!$this->getAuth()->hasIdentity()) {
            $redirect = true;
        } else if(!$redirect) {
            $identity = $this->getAuth()->getIdentity();
            $redirect = $group != $identity->getGroup();
        }
        if($redirect) {
            $this->redirect()->toRoute('auth');
        }
    }

    protected function getParams() {
        $config = $this->getServiceLocator()->get('config');
        $paramsMethod = $config['params_method'];
        $params = null;
        if($paramsMethod == 'any'){
            $params = $this->params()->fromPost();
            if(count($params) <= 0) {
                $params = $this->params()->fromQuery();
            }
        } else if($paramsMethod == 'post'){
            $params = $this->params()->fromPost();
        } else if($paramsMethod == 'get') {
            $params = $this->params()->fromQuery();
        }
        return $params;
    }
    
}
