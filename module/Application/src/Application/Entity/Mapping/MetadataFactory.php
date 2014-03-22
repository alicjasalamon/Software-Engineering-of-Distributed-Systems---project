<?php

namespace Application\Entity\Mapping;

class MetadataFactory extends \Mandango\MetadataFactory
{
    protected $classes = array(
        'Application\\Entity\\User' => false,
        'Application\\Entity\\Institution' => false,
        'Application\\Entity\\Doctor' => false,
        'Application\\Entity\\Patient' => false,
        'Application\\Entity\\Schedule' => false,
        'Application\\Entity\\Day' => false,
        'Application\\Entity\\Stream' => false,
        'Application\\Entity\\Event' => false,
    );
}