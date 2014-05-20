<?php

namespace Application\Model;

use Application\Entity\User;
use Application\Entity\Doctor;
use Application\Entity\Patient;
use Application\Entity\Schedule;
use Application\Utilities\Auth\Encryption;

class UserModel extends EntityModel {
    
    protected $groupActions;
    protected $encryption;
            
    function __construct($mandango) {
        parent::__construct($mandango);
        $this->encryption = new Encryption();
        $this->groupActions = [
            'patient'   => [$this, 'buildPatient'],
            'doctor'    => [$this, 'buildDoctor'],
        ];
    }    
    
    public function getSubUser(User $user) {
        if(!$user) return null;
        $id = $user->getId();
        $group = $user->getGroup();
        if($group == 'admin') {
            return null;
        } else if($group == 'doctor') {
            $doctor = $this->doctorRepository()->createQuery(['user' => $id])->one();
            return $doctor;
        } else if($group == 'patient') {
            $patient = $this->patientRepository()->createQuery(['user' => $id])->one();
            return $patient;
        }
        return null;
    }
    
    public function add($params) {
        $user = $this->buildUser($params);
        $subUser = $this->createSubUser($user, $params);
        if($subUser) {
            $subUser->save();
            return $subUser;
        } else {
            $user->save();
        }
        return [];
    }
    
    public function clear() {
        $this->userRepository()->remove();
    }
    
    public function authenticate($login, $password) {
        $user = $this->userRepository()->createQuery(['login' => $login])->one();
        if(!$user) return false;
        $encryptedPassword = $this->encryption->encrypt($password);
        $user->setPassword($encryptedPassword);
        return $encryptedPassword == $user->getPassword() ? $user : false;
    }

    protected function buildUser($params) {
        $user = new User($this->mandango);
        $user->setLogin($params['login']);
        $encryptedPassword = $this->encryption->encrypt($params['password']);
        $user->setPassword($encryptedPassword);
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
        $schedule = new Schedule($this->mandango);
        $patient->setSchedule($schedule);
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
