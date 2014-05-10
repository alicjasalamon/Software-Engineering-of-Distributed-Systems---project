<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Authentication\AuthenticationServiceInterface;
use Application\Model\Model;
use Zend\View\Model\ViewModel;

abstract class BaseController extends AbstractActionController {
            
    /**
     * @var AuthenticationServiceInterface
     */
    private $auth;
    
    /**
     * @var Model;
     */
    private $model;
    
    public function indexAction() {
        $viewModel = new ViewModel();
        $identity = $this->getAuth()->getIdentity();
        if($identity) {
            $name = $identity->getName();
            $viewModel->setVariable('name', $name);

            $id = $identity->getId();
            $viewModel->setVariable('id', $id);
        }
        return $viewModel;
    }

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
    
    protected function requireAuth($groups = []) {
        if(!$this->getAuth()->hasIdentity()) {
            $this->redirect()->toRoute('auth');
            return;
        } else {
            $identity = $this->getAuth()->getIdentity();
            $inArray = in_array($identity->getGroup(), $groups);
            if(!$inArray && count($groups) > 0) {
                $this->redirect()->toRoute($identity->getGroup());
            }
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
