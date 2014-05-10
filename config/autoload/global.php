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
    
    /*
     * post, get or any 
     * 
     * post: use POST values
     * get: use GET values
     * any:
     *      works as post if there is at least 1 post value
     *      works as get otherwise
     */
    'params_method' => 'any', 
    
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
                'schedule'   => [
                    'class' => 'Application\Entity\Schedule'
                ],
            ],
        ],
        'Application\Entity\Schedule' => [
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
            'referencesMany' => [
                'streams' => [
                    'class' => 'Application\Entity\Stream',
                ],
            ],
        ],
        'Application\Entity\Stream' => [
            'fields' => [
                'activity'      => 'string', // diet, exercises, medicines, visits, measurements
            ],
            'referencesMany' => [
                'events' => [
                    'class' => 'Application\Entity\Event',
                ],
            ],
        ],
        'Application\Entity\Event' => [
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
