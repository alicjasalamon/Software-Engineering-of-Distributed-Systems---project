<?php

namespace Application\Model;

class DoctorModel extends EntityModel {
   
    public function get($params) {
        $doctor = $this->doctorRepository()->findOneById($params['id']);
        $doctorJson = $doctor->toArray(true);
        return $doctorJson;
    }
    
    public function getAll() {
        $doctors = $this->doctorRepository()->createQuery()->all();
        $doctorsJson = array();
        foreach($doctors as $doctor) {
            $json = $doctor->toArray();
            array_push($doctorsJson, $json);
        }
        return $doctorsJson;
    }
    
}
