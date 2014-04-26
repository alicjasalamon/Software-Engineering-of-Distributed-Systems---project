<?php

namespace Application\Entity;

/**
 * Application\Entity\Patient document.
 */
class Patient extends \Application\Entity\Base\Patient
{
    
    public function toArray($withReferenceFields = false)
    {
        $array = array('id' => (string)$this->getId());

        $array['firstname'] = $this->getFirstname();
        $array['lastname'] = $this->getLastname();
        $array['email'] = $this->getEmail();
        
        $array['user'] = (string)$this->getUser_reference_field();
        $array['institution'] = (string)$this->getInstitution_reference_field();
        $array['doctor'] = (string)$this->getDoctor_reference_field();
        //$array['schedule'] = (string)$this->getSchedule_reference_field();

        return $array;
    }
    
}