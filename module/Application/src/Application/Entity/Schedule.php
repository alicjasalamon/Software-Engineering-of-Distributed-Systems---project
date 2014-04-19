<?php

namespace Application\Entity;

/**
 * Application\Entity\Schedule document.
 */
class Schedule extends \Application\Entity\Base\Schedule
{
    
    public function toArray($withReferenceFields = false)
    {
        $array = array('id' => (string)$this->getId());

        $days = $this->getDays()->createQuery()->all();
        $daysIds = [];
        foreach ($days as $day) {
            $dayId = (string)$day->getId();
            array_push($daysIds, $dayId);
        }
        $array['days'] = $daysIds;

        return $array;
    }
    
}