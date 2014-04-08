<?php

namespace Application\Model;

class DoctorModel extends EntityModel {
   
    /**
     * @var \Application\Entity\Doctor
     */
    public function get($params) {
        $doctor = $this->doctorRepository()->findOneById($params['id']);
        return $doctor;
    }
    
    public function getAll() {
        $doctors = $this->doctorRepository()->createQuery()->all();
        return $doctors;
    }
    
    public function clear() {
        $this->doctorRepository()->remove();
    }
    
}
