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
            'doctor' => array(
               'type' => 'segment',
               'options' => array(
                   'route' => '/doctor[/:action]',
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
                   'route' => '/patient[/:action]',
                   'constraints' => array(
                       'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                   ),
                   'defaults' => array(
                       'controller' => 'Application\Controller\Patient',
                       'action' => 'index',
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
            'data' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/data[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Db\DataDb',
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
                        'controller' => 'Application\Controller\Db\Db',
                        'action' => 'index',
                    ),
                ),
            ),
            'userdb' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/db/user[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Db\UserDb',
                        'action' => 'index',
                    ),
                ),
            ),
            'doctordb' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/db/doctor[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Db\DoctorDb',
                        'action' => 'index',
                    ),
                ),
            ),
            'patientdb' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/db/patient[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Db\PatientDb',
                        'action' => 'index',
                    ),
                ),
            ),
            'daydb' => array(
               'type' => 'segment',
               'options' => array(
                   'route' => '/db/day[/:action]',
                   'constraints' => array(
                       'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                   ),
                   'defaults' => array(
                       'controller' => 'Application\Controller\Db\DayDb',
                       'action' => 'index',
                   ),
               ),
            ),
            'institutiondb' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/db/institution[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Db\InstitutionDb',
                        'action' => 'index',
                    ),
                ),
            ),
            'eventdb' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/db/event[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Db\EventDb',
                        'action' => 'index',
                    ),
                ),
            ),
            'measurementsdb' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/db/measurements[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Db\MeasurementsDb',
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
            'AuthAdapter' => function($sm) {
                return new \Application\Auth\AuthAdapter();
            },
            'AuthStorage' => function($sm) {
                return new \Application\Auth\AuthStorage();
            },
            'Auth' => function($sm) {
                $authService = new Zend\Authentication\AuthenticationService();
                $adapter = $sm->get('AuthAdapter');
                $authService->setAdapter($adapter);
                $storage = $sm->get('AuthStorage');
                $authService->setStorage($storage);
                return $authService;
            }
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
        'services' => array(
            'mandango' => $mandango,
        ),
        ''
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
            'Application\Controller\Admin' => 'Application\Controller\AdminController',            
            'Application\Controller\Patient' => 'Application\Controller\PatientController',
            'Application\Controller\Doctor' => 'Application\Controller\DoctorController',
            'Application\Controller\Db\Db' => 'Application\Controller\Db\DbController',
            'Application\Controller\Db\DataDb' => 'Application\Controller\Db\DataDbController',
            'Application\Controller\Db\InstitutionDb' => 'Application\Controller\Db\InstitutionDbController',
            'Application\Controller\Db\DoctorDb' => 'Application\Controller\Db\DoctorDbController',
            'Application\Controller\Db\PatientDb' => 'Application\Controller\Db\PatientDbController',
            'Application\Controller\Db\UserDb' => 'Application\Controller\Db\UserDbController',
            'Application\Controller\Db\EventDb' => 'Application\Controller\Db\EventDbController',
            'Application\Controller\Db\DayDb' => 'Application\Controller\Db\DayDbController',
            'Application\Controller\Db\MeasurementsDb' => 'Application\Controller\Db\MeasurementsDbController',
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
