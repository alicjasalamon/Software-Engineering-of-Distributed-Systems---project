<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ScheduleController extends BaseController {
    
    public function indexAction() {
  
        $streamerViewModel = new ViewModel();
        $streamerViewModel->setTemplate('application/schedule/streamer');
        $renderer = $this->getServiceLocator()->get('ViewRenderer');
        $streamer = $renderer->render($streamerViewModel);
        
        $viewModel = new ViewModel();
        $viewModel->setVariable('streamer', $streamer);
        return $viewModel;
    }
    
    
}
