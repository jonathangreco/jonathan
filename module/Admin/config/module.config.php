<?php
/**
 * Fichier de config du module admin 
 */
return array(
    'router' => array(
        'routes' => array(
            'zfcadmin' => array(
                'options' => array(
                    'route'    => '/backend',
                 ),
            ),
            'backend' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'       => '/backend',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Admin\Service\IndexService' => 'Admin\Factory\IndexServiceFactory',
            'admin_navigation' => 'Admin\Navigation\Service\AdminNavigationFactory',
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
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'Admin\Controller\Index' => 'Admin\Factory\IndexControllerFactory',
        ),
    ),
    'view_manager' => array(
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
        'admin' => array(
             'admin' => array(
                 'label' => 'Admin',
                 'route' => 'backend',
             ),
        ),
    ),
    'jonathan_admin' => array(
        'use_admin_layout' => true,
        'admin_layout_template' => 'layout/admin',
    ),
    'doctrine' => array(
        'driver' => array(
            'admin_entities' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Admin/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                'Admin\Entity' => 'admin_entities'
                )
            )
        )
    ),
    'zfc_rbac' => array(
        'guards' => array(
            'ZfcRbac\Guard\RouteGuard' => array(
                'backend*' => array('admin'),
            )
        )
    ),
);
