<?php

namespace Application\Controller;

use Application\Model\InstitutionModel;
use Application\Model\UserModel;
use Application\Model\DoctorModel;
use Application\Model\PatientModel;

class DbController extends BaseController {
   
    /**
     * @var InstitutionModel
     */
    private $institutionModel;
    
    /**
     * @var UserModel
     */
    private $userModel;
    
    /**
     * @var DoctorModel
     */
    private $doctorModel;
    
    /**
     * @var PatientModel
     */
    private $patientModel;
    
    protected function mandango() {
        return $this->getServiceLocator()->get('mandango');
    }
    
    /**
     * @var InstitutionModel
     */
    protected function institutionModel() {
        if(!$this->institutionModel) {
            $this->institutionModel = new InstitutionModel($this->mandango());
        }
        return $this->institutionModel;
    }
    
    /**
     * @var UserModel
     */
    protected function userModel() {
        if(!$this->userModel) {
            $this->userModel = new UserModel($this->mandango());
        }
        return $this->userModel;
    }
    
    /**
     * @var DoctorModel
     */
    protected function doctorModel() {
        if(!$this->doctorModel) {
            $this->doctorModel = new DoctorModel($this->mandango());
        }
        return $this->doctorModel;
    }
    
    /**
     * @var PatientModel
     */
    protected function patientModel() {
        if(!$this->patientModel) {
            $this->patientModel = new PatientModel($this->mandango());
        }
        return $this->patientModel;
    }
    
}
