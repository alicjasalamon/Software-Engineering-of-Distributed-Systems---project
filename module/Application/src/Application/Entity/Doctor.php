<?php

namespace Application\Entity;

/**
 * Application\Entity\Doctor document.
 */
class Doctor extends \Application\Entity\Base\Doctor
{
    
    public function toArray() {
        $array = parent::toArray();
        $institution = $this->getInstitution();
        $array['institution'] = $institution ? $institution->toArray() : null;
        return $array;
    }
   
}