<?php

namespace Application\Model;
use Application\Entity\User;
use Application\Entity\Doctor;
use Application\Entity\Patient;

class UserModel extends EntityModel {
    
    protected $groupActions;
    
    function __construct($mandango) {
        parent::__construct($mandango);
        $this->groupActions = [
            'patient'   => [$this, 'buildPatient'],
            'doctor'    => [$this, 'buildDoctor'],
        ];
    }
    
    public function add($params) {
        $user = $this->buildUser($params);
        $user->save();
        $subUser = $this->createSubUser($user, $params);
        $subUser->save();
        $json = $subUser ? $subUser->toArray() : [];
        return $json;
    }
    
    protected function buildUser($params) {
        $user = new User($this->mandango);
        $user->setLogin($params['login']);
        $user->setPassword($params['password']); //TODO: sha1
        $user->setGroup($params['group']);        
        return $user;
    }
    
    protected function buildDoctor($user, $params) {
        $institution = $this->fetchInstitution($params);
        $doctor = new Doctor($this->mandango);
        $doctor->setFirstname($params['firstname']);
        $doctor->setLastname($params['lastname']);
        $doctor->setEmail($params['email']);
        $doctor->setInstitution($institution);
        $doctor->setUser($user);
        return $doctor;
    }
    
    protected function buildPatient($user, $params) {
        $institution = $this->fetchInstitution($params);
        $doctor = $this->fetchDoctor($params);
        $patient = new Patient($this->mandango);
        $patient->setFirstname($params['firstname']);
        $patient->setLastname($params['lastname']);
        $patient->setEmail($params['email']);
        $patient->setInstitution($institution);
        $patient->setDoctor($doctor);
        $patient->setUser($user);
        return $patient;
    }

    protected function fetchDoctor($params) {
        $doctor = $this->doctorRepository()->findOneById($params['doctor']);
        return $doctor;
    }
    
    protected function fetchInstitution($params) {
        $institution = $this->institutionRepository()->findOneById($params['institution']);
        return $institution;
    }
    
    protected function createSubUser($user, $params) {
        if(!array_key_exists($params['group'], $this->groupActions)) {
            return null;
        }        
        $groupAction = $this->groupActions[$params['group']];
        $subUser = $groupAction($user, $params);
        return $subUser;
    }
    
    
    
}
