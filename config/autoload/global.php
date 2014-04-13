<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    
    'params_method' => 'post', //post or get
    
    'mandango_config_classes' => [
        'Application\Entity\User' => [
            'fields' => [
                'login'         => 'string',
                'password'      => 'string',
                'group'         => 'string',    // admin / doctor / patient
            ],
        ],
        'Application\Entity\Institution' => [
            'fields' => [
                'name'          => 'string',
            ],
        ],
        'Application\Entity\Doctor' => [
            'fields' => [
                'firstname'     => 'string',
                'lastname'      => 'string',
                'email'         => 'string',
            ],
            'referencesOne' => [
                'user' => [
                    'class' => 'Application\Entity\User'
                ],
                'institution' => [
                    'class' => 'Application\Entity\Institution'
                ],
            ],
        ],
        'Application\Entity\Patient' => [
            'fields' => [
                'firstname'     => 'string',
                'lastname'      => 'string',
                'email'         => 'string',
            ],
            'embeddedsOne' => [
                'schedule'   => [
                    'class' => 'Application\Entity\Schedule'
                ],
            ],
            'referencesOne' => [
                'user' => [
                    'class' => 'Application\Entity\User'
                ],
                'institution' => [
                    'class' => 'Application\Entity\Institution'
                ],
                'doctor' => [
                    'class' => 'Application\Entity\Doctor'
                ],
            ],
        ],
        'Application\Entity\Schedule' => [            
            'isEmbedded' => true,
            'referencesMany' => [
                'days' => [
                    'class' => 'Application\Entity\Day',
                ],
            ],
        ],
        'Application\Entity\Day' => [
            'fields' => [
                'date'          => 'string',
            ],
            'embeddedsMany' => [
                'streams' => [
                    'class' => 'Application\Entity\Stream',
                ],
            ],
        ],
        'Application\Entity\Stream' => [
            'isEmbedded' => true,
            'fields' => [
                'activity'      => 'string', // diet, exercises, medicines, visits
            ],
            'embeddedsMany' => [
                'events' => [
                    'class' => 'Application\Entity\Event',
                ],
            ],
        ],
        'Application\Entity\Event' => [
            'isEmbedded' => true,
            'fields' => [
                'title'         => 'string',
                'details'       => 'string',
                'time'          => 'string',
                'duration'      => 'integer',
                'state'         => 'string', // future, inprogress, done, undone
            ],
        ],
        
    ],    
);
