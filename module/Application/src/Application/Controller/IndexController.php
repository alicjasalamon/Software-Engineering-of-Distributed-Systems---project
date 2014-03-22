<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;

class IndexController extends BaseController {
    public function indexAction() {
        $viewModel = new ViewModel();
        $viewModel->setVariable('zmienna', 'Hello World!');
        return $viewModel;
    }
}
