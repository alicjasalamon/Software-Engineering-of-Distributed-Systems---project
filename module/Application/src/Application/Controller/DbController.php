<?php

namespace Application\Controller;

use Application\Model\InstitutionModel;
use Application\Model\UserModel;
use Application\Model\DoctorModel;
use Application\Model\PatientModel;
use Application\Model\EventModel;
use Application\Model\DayModel;
use Application\Model\ScheduleModel;

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
    
    /**
     * @var EventModel
     */
    private $eventModel;
    
    /**
     * @var DayModel
     */
    private $dayModel;
    
    /**
     * @var ScheduleModel
     */
    private $scheduleModel;
    
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
            $this->patientModel =
                new PatientModel(
                    $this->mandango(), 
                    $this->dayModel(), 
                    $this->eventModel()
                );
        }
        return $this->patientModel;
    }
    
    /**
     * @var EventModel
     */
    protected function eventModel() {
        if(!$this->eventModel) {
            $this->eventModel = new EventModel($this->mandango());
        }
        return $this->eventModel;
    }
    
    /**
     * @var DayModel
     */
    protected function dayModel() {
        if(!$this->dayModel) {
            $this->dayModel = new DayModel($this->mandango());
        }
        return $this->dayModel;
    }
    
    /**
     * @var scheduleModel
     */
    protected function scheduleModel() {
        if(!$this->scheduleModel) {
            $this->scheduleModel = new ScheduleModel($this->mandango());
        }
        return $this->scheduleModel;
    }
    
}
