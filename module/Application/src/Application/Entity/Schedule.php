<?php

namespace Application\Entity;

/**
 * Application\Entity\Schedule document.
 */
class Schedule extends \Application\Entity\Base\Schedule
{
    
    public function toArray($withReferenceFields = false)
    {
        $array = array();

        //references
        $daysReferences = $this->getDays_reference_field();
        $days = [];
        foreach ($daysReferences as $dayReference) {
            $day = (string)$dayReference;
            array_push($days, $day);
        }
        $array['days'] = $days;
                

        return $array;
    }
    
}