<?php

namespace Application\Entity;

/**
 * Application\Entity\Doctor document.
 */
class Doctor extends \Application\Entity\Base\Doctor
{
    
    public function toArray() {
        $array = parent::toArray();
        $array['institution'] = $this->getInstitution()->toArray();
        return $array;
    }
   
}