<?php

namespace Application\Model;

class Model {
    
    private $mandango;
    
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
    
    /**
     * @var StreamModel
     */
    private $streamModel;
    
    public function __construct($mandango) {
        $this->mandango = $mandango;
    }
    
    /**
     * @var InstitutionModel
     */
    public function institutionModel() {
        if(!$this->institutionModel) {
            $this->institutionModel = new InstitutionModel($this->mandango);
        }
        return $this->institutionModel;
    }
    
    /**
     * @var UserModel
     */
    public function userModel() {
        if(!$this->userModel) {
            $this->userModel = new UserModel($this->mandango);
        }
        return $this->userModel;
    }
    
    /**
     * @var DoctorModel
     */
    public function doctorModel() {
        if(!$this->doctorModel) {
            $this->doctorModel = new DoctorModel($this->mandango);
        }
        return $this->doctorModel;
    }
    
    /**
     * @var PatientModel
     */
    public function patientModel() {
        if(!$this->patientModel) {
            $this->patientModel =
                new PatientModel(
                    $this->mandango, 
                    $this->dayModel(), 
                    $this->eventModel()
                );
        }
        return $this->patientModel;
    }
    
    /**
     * @var EventModel
     */
    public function eventModel() {
        if(!$this->eventModel) {
            $this->eventModel = new EventModel($this->mandango);
        }
        return $this->eventModel;
    }
    
    /**
     * @var DayModel
     */
    public function dayModel() {
        if(!$this->dayModel) {
            $this->dayModel = new DayModel($this->mandango);
        }
        return $this->dayModel;
    }
    
    /**
     * @var ScheduleModel
     */
    public function scheduleModel() {
        if(!$this->scheduleModel) {
            $this->scheduleModel = new ScheduleModel($this->mandango);
        }
        return $this->scheduleModel;
    }
    
    /**
     * @var StreamModel
     */
    public function streamModel() {
        if(!$this->streamModel) {
            $this->streamModel = new StreamModel($this->mandango);
        }
        return $this->streamModel;
    }
    
}
