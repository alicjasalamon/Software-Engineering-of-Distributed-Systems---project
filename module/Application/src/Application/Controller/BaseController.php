<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

abstract class BaseController extends AbstractActionController {
    
    protected function generateJSONViewModel($code, $message, $data) {
        $jsonModel = new JsonModel();
        $jsonModel->setVariable('code', $code);
        $jsonModel->setVariable('message', $message);
        $jsonModel->setVariable('data', $data);
        return $jsonModel;
    }
    
    protected function getParams() {
        $config = $this->getServiceLocator()->get('config');
        $paramsMethod = $config['params_method'];
        $params = null;
        if($paramsMethod == 'post'){
            $params = $this->params()->fromPost();
        } else if($paramsMethod == 'get') {
            $params = $this->params()->fromQuery();
        }
        return $params;
    }
    
}
