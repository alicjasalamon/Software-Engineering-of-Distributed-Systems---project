<?php

namespace Application\Entity;

/**
 * Application\Entity\Event document.
 */
class Event extends \Application\Entity\Base\Event
{
    
    public function toArray($withReferenceFields = false)
    {
        $array = array('id' => (string)$this->getId());

        $array['title'] = $this->getTitle();
        $array['details'] = $this->getDetails();
        $array['time'] = $this->getTime();
        $array['duration'] = $this->getDuration();
        $array['state'] = $this->getState();

        return $array;
    }
    
}