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
        $array['events'] = $this->getEvents()->all();

        return $array;
    }
    
}