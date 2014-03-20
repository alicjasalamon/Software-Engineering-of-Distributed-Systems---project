<?php

namespace Application\Controller;

use Exception;
use Zend\View\Model\ViewModel;

class DbController extends BaseController {

    public function indexAction() {
        return new ViewModel();
    }

    public function getAction() {
        $data = 1;
        $viewModel = new ViewModel();
        $viewModel->setVariable('xxx', $data);
        return $viewModel;
    }
    
    public function addUserAction() {
        $params = $this->params()->fromQuery();
        try {
            $userFactory = $this->getServiceLocator()->get('user-factory');
            $user = $userFactory->createAndPersist($params);
            $userJson = $user->toJson();
            $json = $this->generateJSONViewModel(0, '', $userJson);
        } catch (Exception $ex) {
            $json = $this->generateJSONViewModel(1, $ex->getMessage(), null);
        }
        return $json;
    }
    
    public function clearAction() {
        
    }

}
