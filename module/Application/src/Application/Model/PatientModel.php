<?php

namespace Application\Model;

class PatientModel extends EntityModel {
    
    /**
     * @var DayModel
     */
    protected $dayModel;
    
    /**
     * @var EventModel
     */
    protected $eventModel;
    
    
    public function __construct($mandango, DayModel $dayModel, EventModel $eventModel) {
        parent::__construct($mandango);
        $this->dayModel = $dayModel;
        $this->eventModel = $eventModel;
    }
    
    public function get($params) {
        $patient = $this->patientRepository()->findOneById($params['id']);
        return $patient;
    }
    
    public function getAll() {
        $patients = $this->patientRepository()->createQuery()->all();
        return $patients;
    }
    
    public function getDay($params) {
        $patient = $this->patientRepository()->findOneById($params['patientid']);
        $day = $this->dayModel->get($patient, $params['date']);
        if($day->isNew()) {
            $day->save();
            $patient->save();
        }
        return $day;
    }
    
    public function addEvent($params) {
        $patient = $this->patientRepository()->findOneById($params['patientid']);
        $day = $this->dayModel->get($patient, $params['date']);
        $event = $this->eventModel->addEvent($day, $params);
        $patient->save();
        return $event;
    }
    
    public function clear() {
        $this->patientRepository()->remove();
    }
        
}
