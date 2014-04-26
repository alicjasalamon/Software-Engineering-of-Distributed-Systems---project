<?php

namespace Application\Entity;

/**
 * Application\Entity\Schedule document.
 */
class Schedule extends \Application\Entity\Base\Schedule
{
    
    public function toArray($withReferenceFields = false)
    {
        $array = [];
        
        //$array = array('id' => (string)$this->getId());

        $array['days'] = $this->getDays_reference_field();

        return $array;
    }
    
}