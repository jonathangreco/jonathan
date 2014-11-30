<?php
$settings = array(
    'enable_username' => true,
    'auth_adapters' => array( 100 => 'ZfcUser\Authentication\Adapter\Db' ),
    'enable_display_name' => true,
    'use_registration_form_captcha' => true,
    'form_captcha_options' => array(
        'class'   => 'figlet',
        'options' => array(
            'wordLen'    => 5,
            'expiration' => 300,
            'timeout'    => 300,
        ),
    ),
    'logout_redirect_route' => 'home',
    'enable_user_state' => true,
    'default_user_state' => 1,
    'allowed_login_states' => array(1),
);
return array(
    'zfcuser' => $settings,
    'service_manager' => array(
        'aliases' => array(
            'zfcuser_zend_db_adapter' => (isset($settings['zend_db_adapter'])) ? $settings['zend_db_adapter']: 'Zend\Db\Adapter\Adapter',
        ),
    ),
);
