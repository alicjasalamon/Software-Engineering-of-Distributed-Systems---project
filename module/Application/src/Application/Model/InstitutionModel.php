<?php

namespace Application\Model;
use Application\Entity\Institution;

class InstitutionModel extends EntityModel {
    
    public function get($params) {
        $institution = $this->institutionRepository()->findOneById($params['id']);
        return $institution;
    }
    
    public function getAll() {
        $institutions = $this->institutionRepository()->createQuery()->all();
        return $institutions;
    }
    
    public function add($params) {
        $institution = new Institution($this->mandango);
        $institution->setName($params['name']);
        $this->institutionRepository()->save($institution);
        return $institution;
    }
    
    public function clear() {
        $this->institutionRepository()->remove();
    }
    
}
