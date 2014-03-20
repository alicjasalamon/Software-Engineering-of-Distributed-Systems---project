<?php

namespace Application\Model;
use Application\Entity\Institution;

class InstitutionModel extends EntityModel {
    
    public function getAction($params) {
        $institution = $this->institutionRepository->findOneById($params['id']);
        $institutionJson = $institution->toArray();
        return $institutionJson;
    }
    
    public function addAction($params) {
        $institution = new Institution($this->mandango);
        $institution->setName($params['name']);
        $this->institutionRepository->save($institution);
        $institutionJson = $institution->toArray();
        return $institutionJson;
    }
    
    public function allAction() {
        $institutions = $this->institutionRepository->createQuery()->all();
        $institutionsJson = array();
        foreach($institutions as $institution) {
            $json = $institution->toArray();
            array_push($institutionsJson, $json);
        }
        return $institutionsJson;
    }
    
}
