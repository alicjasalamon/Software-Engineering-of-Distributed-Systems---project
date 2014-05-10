<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;

class AdminController extends BaseController {
    
    public function indexAction() {
        $this->requireAuth(['admin']);
        
        $viewModel = parent::indexAction();
        $renderer = $this->getServiceLocator()->get('ViewRenderer');
        
        $addInstitutionViewModel = new ViewModel();
        $addInstitutionViewModel->setTemplate('application/admin/addInstitution');
        $addInstitutionHtml = $renderer->render($addInstitutionViewModel);

        $addDoctorViewModel = new ViewModel();
        $addDoctorViewModel->setTemplate('application/admin/addDoctor');
        $addDoctorHtml = $renderer->render($addDoctorViewModel);

        $addPatientViewModel = new ViewModel();
        $addPatientViewModel->setTemplate('application/admin/addPatient');
        $addPatientHtml = $renderer->render($addPatientViewModel);
        
        $viewModel->setVariable('addInstitution', $addInstitutionHtml);
        $viewModel->setVariable('addDoctor', $addDoctorHtml);
        $viewModel->setVariable('addPatient', $addPatientHtml);
        
        return $viewModel;
    }

}
