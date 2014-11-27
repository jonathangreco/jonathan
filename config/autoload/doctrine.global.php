<?php

return array(
  'doctrine' => array(
    'connection' => array(
      'orm_default' => array(
        'driverClass' =>'Doctrine\DBAL\Driver\PDOMySql\Driver',
        'params' => array(
          'host'     => 'localhost',
          'port'     => '3306',
          'user'     => 'root',
          'password' => 'DOC42/sourcing',
          'dbname'   => 'jonathan',
          'charset' => 'UTF8',
          'driverOptions' => array (1002 => 'SET NAMES utf8'),
        )
      ),
    ),
    'authentication' => array(
        'orm_default' => array(
            'object_manager' => 'Doctrine\ORM\EntityManager',
            'identity_class' => 'Application\Entity\User',
            'identity_property' => 'email',
            'credential_property' => 'password',
        ),
    ),
  )
);