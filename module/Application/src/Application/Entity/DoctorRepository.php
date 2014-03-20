<?php

namespace Application\Entity;

/**
 * Repository of Application\Entity\Doctor document.
 */
class DoctorRepository extends \Application\Entity\Base\DoctorRepository
{
    function __construct(\Mandango\Mandango $mandango) {
        parent::__construct($mandango);
    }
    
}