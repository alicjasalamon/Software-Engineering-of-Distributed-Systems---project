<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class BaseController extends AbstractActionController {
    
    protected function generateJSONViewModel($code, $message, $data) {
        $jsonModel = new JsonModel();
        $jsonModel->setVariable('code', $code);
        $jsonModel->setVariable('message', $message);
        $jsonModel->setVariable('data', $data);
        $viewModel = new ViewModel();
        $viewModel->setVariable('json', $jsonModel);
        $viewModel->setTerminal(true);
        return $viewModel;
    }
    
}
