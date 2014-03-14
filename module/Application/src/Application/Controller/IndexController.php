<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
//use Exception;

class IndexController extends AbstractActionController {
    public function indexAction() {
        //throw new Exception();
        $viewModel = new ViewModel();
        $viewModel->setVariable('zmienna', 'Hello World!');
        return $viewModel;
    }
}
