<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;

class DoctorController extends ScheduleController
{
    
    public function indexAction() {
        $viewModel = parent::indexAction();
        $renderer = $this->getServiceLocator()->get('ViewRenderer');
        $selectPatientsViewModel = new ViewModel();
        $selectPatientsViewModel->setTemplate('application/doctor/select-patients');
        $selectPatients = $renderer->render($selectPatientsViewModel);
        $viewModel->setVariable('selectPatients', $selectPatients);
        
        $eventDialogsViewModel = new ViewModel();
        $eventDialogsViewModel->setTemplate('application/doctor/eventDialogs');
        $eventDialogsHtml = $renderer->render($eventDialogsViewModel);
        $viewModel->setVariable('eventDialogs', $eventDialogsHtml);
        
        return $viewModel;
    }

}

