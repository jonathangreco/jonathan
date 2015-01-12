<?php

return array(
	'admin' => array(
        'admin' => array(
            'label' => 'backoffice',
            'route' => 'backoffice',
        ),
        'rights' => array(
            'label' => 'Rights management',
            'route' => 'backoffice/rights',
            'controller' => 'Admin\Controller\Rights',
            'pages' => array(
                array(
                    'label' => 'Add',
                    'route' => 'backoffice/rights/addRole',
                    'controller' => 'Admin\Controller\Rights',
                    'visible' => false,
                ),
                array(
                    'label' => 'delete',
                    'route' => 'backoffice/rights/deleteRole',
                    'controller' => 'Admin\Controller\Rights',
                    'visible' => false,
                ),
                array(
                    'label' => 'update',
                    'route' => 'backoffice/rights/updateRole',
                    'controller' => 'Admin\Controller\Rights',
                    'visible' => false,
                ),
            ),
        )
    ),
);