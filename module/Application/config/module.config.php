<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application;

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
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            'changelocale' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/changelocale[/:locale[/:redirecturl]]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Translator',
                        'action' => 'changelocale',
                        'locale' => '',
                        'redirecturl' => ''
                    )
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
            'zfcuser_doctrine_em' => 'Doctrine\ORM\EntityManager',
            'Zend\Authentication\AuthenticationService' => 'zfcuser_auth_service',
        ),
        'factories' => array(
            'default' => 'Zend\Navigation\Service\DefaultNavigationFactory',
            'translate' => 'Zend\I18n\Translator\TranslatorServiceFactory',
            'Application\Service\IndexService' => 'Application\Factory\IndexServiceFactory',
        ),
        'invokables' => array(
            'FlashMessageListener' => 'Application\Listener\FlashMessageListener',
        ),
    ),
    'translator' => array(
        'locale' => 'fr_FR',
        'translation_file_patterns' => array(
            array(
                'type'     => 'phpArray',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.php',
            ),
            array(
                'type'     => 'phpArray',
                'base_dir' => __DIR__ . '/../language/Zend_validate/%s.php',
                'pattern'  => '%s.php',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Translator' => 'Application\Controller\TranslatorController'
        ),
        'factories' => array(
            'Application\Controller\Index' => 'Application\Factory\IndexControllerFactory',
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
            ),
        ),
    ),
    'navigation' => array(
        'default' => array(
            'home' => array(
                'label' => 'Home',
                'route' => 'home',
            ),
        ),
    ),
    'doctrine'        => array(
        'driver' => array(
            'application_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => __DIR__ . '/../src/' . __NAMESPACE__ . '/Entity',
            ),
            'orm_default'  => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => 'application_entity',
                )
            )
        )
    ),
    'zfcuser' => array(
        'user_entity_class' => 'Application\Entity\User',
        'enable_default_entities' => false,
    ),
    'zfc_rbac' => array(
        'guards' => array(
            'ZfcRbac\Guard\RouteGuard' => array(
                'home' => array('*'),
                'changelocale' => array('*'),
                'doctrine_orm_module_yuml' => array('*'),
                'zfcuser/login' => array('guest'),
                'zfcuser/register' => array('guest'),
                'zfcuser*' => array('user'),
            )
        )
    ),
);
