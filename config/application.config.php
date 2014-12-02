<?php
/**
 * @author Jonathan Greco <nataniel.greco@gmail.com>
 */
return array(
    'modules' => array(
        'DoctrineModule',
        'DoctrineORMModule',
        'ZfcBase',
        'ZfcUser',
        'ZfcUserDoctrineORM',
        'ZfcRbac',
        'ZendDeveloperTools',
        'ZfcAdmin',
        'Application',
        'Admin',
        'User',
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor',
        ),
        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
    ),
);
