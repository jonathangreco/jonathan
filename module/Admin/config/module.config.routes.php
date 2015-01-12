<?php

return array(
	'routes' => array(
        'zfcadmin' => array(
            'options' => array(
                'route'    => '/backoffice',
             ),
        ),
        'backoffice' => array(
            'type'    => 'Literal',
            'options' => array(
                'route'       => '/backoffice',
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
                        'addPermission' => array(
                            'type' => 'Segment',
                            'options' => array(
                                'route' => '/add-permission',
                                'defaults' => array(
                                    'controller' => 'Admin\Controller\Rights',
                                    'action' => 'addPermission'
                                )
                            )
                        ),
                    ),
                ),
            ),
        ),
    ),
);
