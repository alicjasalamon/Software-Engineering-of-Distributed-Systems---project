<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

use Mandango\Mandango;
use Mandango\Connection;
use Mandango\Cache\FilesystemCache;
use \Application\Entity\Factories\UserFactory;

$config = array(
    'host'  => 'localhost',
    'port'  => '27017',
    'db'    => 'iosr',
);

//mandango
$metadataFactory = new \Application\Entity\Mapping\MetadataFactory();
$cache = new FilesystemCache('cache');
$mandango = new Mandango($metadataFactory, $cache);
$url = 'mongodb://' . $config['host'] . ':' . $config['port'];
$mandango->setConnections(array(
    'global'  => new Connection($url, $config['db']),
    //'other' => new Connection('mongodb://localhost:27017', 'iosr'),
));
$mandango->setDefaultConnectionName('global');

//factories
$userFactory = new UserFactory($mandango);

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            
            'db' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/db[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Db',
                        'action' => 'index',
                    ),
                ),
            ),
            'schedule' => array(
               'type' => 'segment',
               'options' => array(
                   'route' => '/schedule[/:action]',
                   'constraints' => array(
                       'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                   ),
                   'defaults' => array(
                       'controller' => 'Application\Controller\Schedule',
                       'action' => 'index',
                   ),
               ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
        'services' => array(
            'mandango' => $mandango,
            'user-factory' => $userFactory,
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'MandangoModule\Console' => 'MandangoModule\Controller\ConsoleController',
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Db' => 'Application\Controller\DbController',
            'Application\Controller\Schedule' => 'Application\Controller\ScheduleController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
                'mandango_module_mondator_process' => array(
                    'options' => array(
                        'route'    => 'mandango mondator process',
                        'defaults' => array(
                            'controller' => 'MandangoModule\Console',
                            'action'     => 'mondator-process',
                        ),
                    ),
                ),
            ),
        ),
    ),
    'modules' => array(
        'ZendDeveloperTools',
        'Application',
    ),
);
