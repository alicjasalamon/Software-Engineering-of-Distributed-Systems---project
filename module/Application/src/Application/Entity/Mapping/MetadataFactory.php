<?php

namespace Application\Entity\Mapping;

class MetadataFactory extends \Mandango\MetadataFactory
{
    protected $classes = array(
        'Application\\Entity\\User' => false,
    );
}