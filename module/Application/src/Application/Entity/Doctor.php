<?php

namespace Application\Entity;

/**
 * Application\Entity\Doctor document.
 */
class Doctor extends \Application\Entity\Base\Doctor
{
    
    public function toArray($withReferenceFields = false)
    {
        $array = array('id' => (string)$this->getId());

        $array['firstname'] = $this->getFirstname();
        $array['lastname'] = $this->getLastname();
        $array['email'] = $this->getEmail();
        
        //references
        $array['user'] = (string)$this->getUser_reference_field();
        $array['institution'] = (string)$this->getInstitution_reference_field();

        return $array;
    }
    
}