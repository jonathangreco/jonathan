<?php

return array(
    'factories' => array(
        'Admin\Service\IndexService' => 'Admin\Factory\IndexServiceFactory',
        'Admin\Service\RightsService' => 'Admin\Factory\RightsServiceFactory',
        'admin_navigation' => 'Admin\Navigation\Service\AdminNavigationFactory',
    ),
);
