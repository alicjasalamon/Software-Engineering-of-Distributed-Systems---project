<?php

namespace Application\Entity\Mapping;

class MetadataFactory extends \Mandango\MetadataFactory
{
    protected $classes = array(
        'Application\\Entity\\User' => false,
        'Application\\Entity\\Institution' => false,
        'Application\\Entity\\Doctor' => false,
        'Application\\Entity\\Patient' => false,
        'Application\\Entity\\Schedule' => true,
        'Application\\Entity\\Day' => true,
        'Application\\Entity\\Stream' => true,
        'Application\\Entity\\Event' => true,
    );
}