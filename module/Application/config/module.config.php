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
use Application\Entity\Mapping\MetadataFactory;

$config = array(
    'host'  => 'localhost',
    'port'  => '27017',
    'db'    => 'iosr',
);

$metadataFactory = new MetadataFactory();
$cache = new FilesystemCache('cache');
$mandango = new Mandango($metadataFactory, $cache);
$url = 'mongodb://' . $config['host'] . ':' . $config['port'];
$mandango->setConnections(array(
    'global'  => new Connection($url, $config['db']),
    //'other' => new Connection('mongodb://localhost:27017', 'iosr'),
));
$mandango->setDefaultConnectionName('global');

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
            'auth' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/auth[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Auth',
                        'action' => 'index',
                    ),
                ),
            ),
            'data' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/data[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Data',
                        'action' => 'index',
                    ),
                ),
            ),
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
            'admin' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Admin',
                        'action' => 'index',
                    ),
                ),
            ),
            'user' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/db/user[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\User',
                        'action' => 'index',
                    ),
                ),
            ),
            'doctor' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/db/doctor[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Doctor',
                        'action' => 'index',
                    ),
                ),
            ),
            'patient' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/db/patient[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Patient',
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
            'institution' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/db/institution[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Institution',
                        'action' => 'index',
                    ),
                ),
            ),
            'event' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/db/event[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Event',
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
            'Application\Controller\Auth' => 'Application\Controller\AuthController',
            'Application\Controller\Admin' => 'Application\Controller\AdminController',            'Application\Controller\Db' => 'Application\Controller\DbController',
            'Application\Controller\Data' => 'Application\Controller\DataController',
            'Application\Controller\Institution' => 'Application\Controller\InstitutionController',
            'Application\Controller\Doctor' => 'Application\Controller\DoctorController',
            'Application\Controller\Patient' => 'Application\Controller\PatientController',
            'Application\Controller\Schedule' => 'Application\Controller\ScheduleController',
            'Application\Controller\User' => 'Application\Controller\UserController',
            'Application\Controller\Event' => 'Application\Controller\EventController',
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
        'strategies' => array(
            'ViewJsonStrategy',
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
