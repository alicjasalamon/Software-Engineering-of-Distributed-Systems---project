<?php

namespace Application\Entity;

/**
 * Application\Entity\Institution document.
 */
class Institution extends \Application\Entity\Base\Institution
{
    
    public function toArray($withReferenceFields = false)
    {
        $array = array('id' => (string)$this->getId());

        $array['name'] = $this->getName();

        return $array;
    }
    
}