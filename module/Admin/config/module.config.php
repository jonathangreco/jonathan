<?php
/**
 * Fichier de config du module admin 
 * @author Jonathan Greco <nataniel.greco@gmail.com>
 */
return array(
    'router' => include 'module.config.routes.php',
    'form_elements'   => include 'module.config.formmanager.php',
    'service_manager' => include 'module.config.servicemanager.php',
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
    'controllers' => include 'module.config.controllers.php',
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
    'navigation' => include 'module.config.navigation.php',
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
                'backoffice*' => array('admin'),
            )
        )
    ),
);
