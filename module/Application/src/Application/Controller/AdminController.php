<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;

class AdminController extends BaseController  //dziedziczymy tu po zendowej klasce, 
//ale zrobilem dodatkowa klase ktora dziedziczy po AbstractActionController 
//i dodaje do niej kilka funkcjonalnosci {
{
    public function indexAction() {
        $viewModel = new ViewModel();
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
