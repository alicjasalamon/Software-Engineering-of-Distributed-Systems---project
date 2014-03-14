<?php

namespace Application\Entity;

/**
 * Application\Entity\User document.
 */
class User extends \Application\Entity\Base\User
{
    public function initialize($name) {
        $this->setName($name);
    }
    
    public function toJson() {
        return array(
            'name' => $this->getName(),
        );
    }

}