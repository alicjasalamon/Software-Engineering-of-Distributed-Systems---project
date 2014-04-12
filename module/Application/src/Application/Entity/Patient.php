<?php

namespace Application\Entity;

/**
 * Application\Entity\Patient document.
 */
class Patient extends \Application\Entity\Base\Patient
{
    
    public function toArray($withReferenceFields = false)
    {
        $array = array('id' => $this->getId());

        $array['firstname'] = $this->getFirstname();
        $array['lastname'] = $this->getLastname();
        $array['email'] = $this->getEmail();
        if ($withReferenceFields) {
            $array['user_reference_field'] = $this->getUser_reference_field();
        }
        if ($withReferenceFields) {
            $array['institution_reference_field'] = $this->getInstitution_reference_field();
        }
        if ($withReferenceFields) {
            $array['doctor_reference_field'] = $this->getDoctor_reference_field();
        }
        $array['schedule'] = $this->getSchedule()->toArray(true);

        return $array;
    }
    
}