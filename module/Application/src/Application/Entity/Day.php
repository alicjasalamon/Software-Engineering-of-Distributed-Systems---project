<?php

namespace Application\Entity;

/**
 * Application\Entity\Day document.
 */
class Day extends \Application\Entity\Base\Day
{
    
    public function toArray($withReferenceFields = false)
    {
        $array = array('id' => $this->getId());

        $array['date'] = $this->getDate();
        $array['streams'] = $this->getStreams()->all();

        return $array;
    }
    
}