<?php

namespace Application\Entity;

/**
 * Application\Entity\User document.
 */
class User extends \Application\Entity\Base\User
{
    
    public function toArray($withReferenceFields = false)
    {
        $array = array('id' => (string)$this->getId());

        $array['login'] = $this->getLogin();
        $array['password'] = $this->getPassword();
        $array['group'] = $this->getGroup();

        return $array;
    }
    
}