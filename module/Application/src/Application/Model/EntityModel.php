<?php

namespace Application\Model;
use Application\Entity\DoctorRepository;
use Application\Entity\PatientRepository;
use Application\Entity\InstitutionRepository;

abstract class EntityModel {
    
    /**
     * @var Mandango
     */
    protected $mandango;
    
    /**
     * @var DoctorRepository
     */
    private $doctorRepository;
    
    /**
     * @var PatientRepository
     */
    private $patientRepository;
    
    /**
     * @var InstitutionRepository
     */
    private $institutionRepository;
    
    function __construct($mandango) {
        $this->mandango = $mandango;
    }
    
    /**
     * @var DoctorRepository
     */
    protected function doctorRepository() {
        if(!$this->doctorRepository) {
            $this->doctorRepository = new DoctorRepository($this->mandango);
        }
        return $this->doctorRepository;
    }
    
    /**
     * @var PatientRepository
     */
    protected function patientRepository() {
        if(!$this->patientRepository) {
            $this->patientRepository = new PatientRepository($this->mandango);
        }
        return $this->patientRepository;
    }

    /**
     * @var InstitutionRepository
     */
    protected function institutionRepository() {
        if(!$this->institutionRepository) {
            $this->institutionRepository = new InstitutionRepository($this->mandango);
        }
        return $this->institutionRepository;
    }
    
    
}
