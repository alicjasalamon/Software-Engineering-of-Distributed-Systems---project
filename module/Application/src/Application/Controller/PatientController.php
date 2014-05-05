<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;

class PatientController extends ScheduleController
{

    public function indexAction() {
        $this->requireAuth('patient');
        
        $viewModel = parent::indexAction();
        $eventDialogsViewModel = new ViewModel();
        $renderer = $this->getServiceLocator()->get('ViewRenderer');
        $eventDialogsViewModel->setTemplate('application/patient/eventDialogs');
        $eventDialogsHtml = $renderer->render($eventDialogsViewModel);
        $viewModel->setVariable('eventDialogs', $eventDialogsHtml);
        return $viewModel;
    }
    
}

