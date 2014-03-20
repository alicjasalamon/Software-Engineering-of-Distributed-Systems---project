<?php

namespace Application\Model;
use Application\Entity\InstitutionRepository;
use Application\Entity\DoctorRepository;

abstract class EntityModel {
    
    protected $mandango;
    protected $doctorRepository;
    protected $institutionRepository;
    
    function __construct($mandango) {
        $this->mandango = $mandango;
        $this->doctorRepository = new DoctorRepository($this->mandango);
        $this->institutionRepository = new InstitutionRepository($this->mandango);
    }  
    
}
