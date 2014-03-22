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
                'firstname'     => 'string',
                'lastname'      => 'string',
                'login'         => 'string',
                'password'      => 'string',
                'email'         => 'string',
                'group'         => 'string',    // admin / doctor / patient
            ],
        ],
        'Application\Entity\Institution' => [
            'fields' => [
                'name'          => 'string',
            ],
        ],
        'Application\Entity\Doctor' => [
            'referencesOne' => [
                'institution' => [
                    'class' => 'Application\Entity\Institution'
                ],
                'user' => [
                    'class' => 'Application\Entity\User'
                ]
            ],
        ],
        'Application\Entity\Patient' => [
            'embeddedsOne' => [
                'schedule'   => [
                    'class' => 'Application\Entity\Schedule'
                ],
            ],
            'referencesOne' => [
                'institution' => [
                    'class' => 'Application\Entity\Institution'
                ],
                'doctor' => [
                    'class' => 'Application\Entity\Doctor'
                ],
                'user' => [
                    'class' => 'Application\Entity\User'
                ],
            ],
        ],
        'Application\Entity\Schedule' => [
            'embeddedsMany' => [
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
            'fields' => [
                'title'         => 'string',
                'details'       => 'string',
                'start'         => 'string',
                'duration'      => 'integer',
                'state'         => 'string', // future, inprogress, done, undone
            ],
        ],
        
    ],    
);
