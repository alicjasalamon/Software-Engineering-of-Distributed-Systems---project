<?php

namespace Application\Model;
use Application\Entity\InstitutionRepository;
use Application\Entity\DoctorRepository;

abstract class EntityModel {
    
    /**
     * @var Mandango
     */
    protected $mandango;
    
    /**
     * @var DoctorRepository
     */
    protected $doctorRepository;
    
    /**
     * @var InstitutionRepository
     */
    protected $institutionRepository;
    
    function __construct($mandango) {
        $this->mandango = $mandango;
        $this->doctorRepository = new DoctorRepository($this->mandango);
        $this->institutionRepository = new InstitutionRepository($this->mandango);
    }  
    
}
