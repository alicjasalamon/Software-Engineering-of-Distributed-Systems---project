<?php

namespace Application\Model;
use Application\Entity\DoctorRepository;
use Application\Entity\Doctor;
use Application\Entity\InstitutionRepository;
use Application\Entity\Institution;

class DoctorModel extends EntityModel {
   
    public function getAction($params) {
        $doctor = $this->doctorRepository->findOneById($params['id']);
        $doctorJson = $doctor->toArray(true);
        return $doctorJson;
    }
    
    public function addAction($params) {
        $doctor = $this->buildDoctor($params);
        $doctor->save();
        $doctorJson = $doctor->toArray();
        return $doctorJson;
    }
    
    public function updateInstitutionAction($params) {
        $doctor = $this->doctorRepository->findOneById($params['doctorid']);
        $institution = $this->institutionRepository->findOneById($params['institutionid']);
        $doctor->setInstitution($institution);
        $doctor->save();
        $doctorJson = $doctor->toArray();
        return $doctorJson;
    }
    
    private function buildDoctor($params) {
        $doctor = new Doctor($this->mandango);
        $doctor->setFirstname($params['firstname']);
        $doctor->setLastname($params['lastname']);
        $doctor->setLogin($params['login']);
        $doctor->setPassword($params['password']);
        $doctor->setEmail($params['email']);
        return $doctor;
    }
    
}
