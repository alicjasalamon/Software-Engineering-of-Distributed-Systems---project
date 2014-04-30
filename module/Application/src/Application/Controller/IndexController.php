<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;

class IndexController extends BaseController {
    
    public function indexAction() {
        $this->requireAuth();
        
        $viewModel = new ViewModel();
        $viewModel->setVariable('zmienna', 'Hello World!');
        return $viewModel;
    }
    
}
