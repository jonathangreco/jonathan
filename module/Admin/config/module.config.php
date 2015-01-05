<?php
/**
 * Fichier de config du module admin 
 * @author Jonathan Greco <nataniel.greco@gmail.com>
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
                'child_routes' => array(
                    'rights' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/rights',
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Rights',
                                'action' => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'updateRole' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/update-role[/:id]',
                                    'defaults' => array(
                                        'controller' => 'Admin\Controller\Rights',
                                        'action' => 'updateRole'
                                    )
                                )
                            ),
                            'deleteRole' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/delete-role[/:id]',
                                    'defaults' => array(
                                        'controller' => 'Admin\Controller\Rights',
                                        'action' => 'deleteRole'
                                    )
                                )
                            ),
                            'addRole' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/add-role',
                                    'defaults' => array(
                                        'controller' => 'Admin\Controller\Rights',
                                        'action' => 'addRole'
                                    )
                                )
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'form_elements'   => array(
        'invokables' => array(
            'Admin\Form\AddRole'        => 'Admin\Form\AddRoleForm',
            'Admin\Form\UpdateRole'     => 'Admin\Form\UpdateRoleForm',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Admin\Service\IndexService' => 'Admin\Factory\IndexServiceFactory',
            'Admin\Service\RightsService' => 'Admin\Factory\RightsServiceFactory',
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
            'Admin\Controller\Rights' => 'Admin\Factory\RightsControllerFactory',
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
                'label' => 'Backend',
                'route' => 'backend',
            ),
            'rights' => array(
                'label' => 'Rights management',
                'route' => 'backend/rights',
                'controller' => 'Admin\Controller\Rights',
                'pages' => array(
                    array(
                        'label' => 'Add',
                        'route' => 'backend/rights/addRole',
                        'controller' => 'Admin\Controller\Rights',
                        'visible' => false,
                    ),
                    array(
                        'label' => 'delete',
                        'route' => 'backend/rights/deleteRole',
                        'controller' => 'Admin\Controller\Rights',
                        'visible' => false,
                    ),
                    array(
                        'label' => 'update',
                        'route' => 'backend/rights/updateRole',
                        'controller' => 'Admin\Controller\Rights',
                        'visible' => false,
                    ),
                ),
            )
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
