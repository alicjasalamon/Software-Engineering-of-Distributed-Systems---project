<?php

namespace Application\Entity;

/**
 * Application\Entity\Day document.
 */
class Day extends \Application\Entity\Base\Day
{
    
    public function toArray($withReferenceFields = false)
    {
        $array = array('id' => (string)$this->getId());

        $array['date'] = $this->getDate();
        
        $streams = $this->getStreams()->all();
        $streamsArray = [];
        foreach($streams as $stream) {
            array_push($streamsArray, $stream->toArray(true));
        }
        $array['streams'] = $streamsArray;

        return $array;
    }
    
}