<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;

class ScheduleController extends BaseController {
    
    public function indexAction() {
        $viewModel = parent::indexAction();
        
        $renderer = $this->getServiceLocator()->get('ViewRenderer');
        
        $streamerViewModel = new ViewModel();
        $streamerViewModel->setTemplate('application/schedule/streamer');
        $streamer = $renderer->render($streamerViewModel);
        $viewModel->setVariable('streamer', $streamer);

        return $viewModel;
    }
    
}
