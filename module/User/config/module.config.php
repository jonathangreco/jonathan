<?php
/**
 * 
 * @package User
 * @author Jonathan Greco <jgreco@docsourcing.com>
 */
namespace User;
return array(
    'controllers' => array(
        'factories' => array(
            'User\Controller\User' => 'User\Factory\UserControllerFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'zfcuser' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/my-account',
                    'defaults' => array(
                        'controller' => 'User\Controller\User',
                        'action' => 'accountUser'
                    )
                )
            )
        ),
    ),
    'translator' => array(
        'locale' => 'fr_FR',
        'translation_file_patterns' => array(
            array(
                'type'     => 'phpArray',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.global.php',
            ),
            array(
                'type' => 'phpArray',
                'base_dir' => __DIR__ . '/../language/FlashMessage/',
                'pattern'  => '%s-flashMessage.php',
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'User\Service\User' => 'User\Factory\UserServiceFactory',
            'User\Listener\RegisterUserListener' => 'User\Factory\RegisterUserFactory',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'user' => __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'User_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => __DIR__ . '/../src/'.__NAMESPACE__.'/Entity',
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__.'\Entity' => 'User_entity',
                )
            )
        )
    ),
    'navigation' => array(
        'default' => array(
            'zfcuser' => array(
                'label' => 'Account',
                'route' => 'zfcuser',
                'permission' => 'seeAccount',
            ),
        )
    )
);