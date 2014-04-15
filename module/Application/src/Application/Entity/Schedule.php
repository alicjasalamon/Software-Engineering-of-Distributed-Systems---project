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

        $days = $this->getDays()->createQuery()->all();
        $daysIds = [];
        foreach ($days as $dayReference) {
            $day = (string)$dayReference->getId();
            array_push($daysIds, $day);
        }
        $array['days'] = $daysIds;
                

        return $array;
    }
    
}