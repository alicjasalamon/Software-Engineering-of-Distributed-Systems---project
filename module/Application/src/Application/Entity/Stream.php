<?php

namespace Application\Entity;

/**
 * Application\Entity\Stream document.
 */
class Stream extends \Application\Entity\Base\Stream
{
    
    public function toArray($withReferenceFields = false)
    {
        $array = array();

        $array['activity'] = $this->getActivity();
        
        $events = $this->getEvents()->all();
        $eventsArray = [];
        foreach ($events as $event) {
            array_push($eventsArray, $event->toArray());
        }
        $array['events'] = $eventsArray;

        return $array;
    }
    
}