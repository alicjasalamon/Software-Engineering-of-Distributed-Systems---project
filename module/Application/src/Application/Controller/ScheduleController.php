<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;

class ScheduleController extends BaseController {
    
    public function indexAction() {
        $this->requireAuth();
        
        $viewModel = new ViewModel();
        $viewModel->setTemplate('application/schedule/index');
        
        $renderer = $this->getServiceLocator()->get('ViewRenderer');
        
        $streamerViewModel = new ViewModel();
        $streamerViewModel->setTemplate('application/schedule/streamer');
        $streamer = $renderer->render($streamerViewModel);
        
 /*       $eventDialogsViewModel = new ViewModel();
        $eventDialogsViewModel->setTemplate('application/schedule/eventDialogs');
        $eventDialogsHtml = $renderer->render($eventDialogsViewModel);*/

        $viewModel->setVariable('streamer', $streamer);
  //      $viewModel->setVariable('eventDialogs', $eventDialogsHtml);
        
        return $viewModel;
    }
    
}
