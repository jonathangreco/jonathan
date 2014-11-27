<?php
/**
 * ZfcUser Configuration
 *
 * If you have a ./config/autoload/ directory set up for your project, you can
 * drop this config file in it and change the values as you wish.
 */
$settings = array(

    /**
     * Enable Username
     *
     * Enables username field on the registration form, and allows users to log
     * in using their username OR email address. Default is false.
     *
     * Accepted values: boolean true or false
     */
    'enable_username' => true,

    /**     
     * Authentication Adapters
     *
     * Specify the adapters that will be used to try and authenticate the user
     *
     * Default value: array containing 'ZfcUser\Authentication\Adapter\Db' with priority 100
     * Accepted values: array containing services that implement 'ZfcUser\Authentication\Adapter\ChainableAdapter'
     */
    'auth_adapters' => array( 100 => 'ZfcUser\Authentication\Adapter\Db' ),

    /**
     * Enable Display Name
     *
     * Enables a display name field on the registration form, which is persisted
     * in the database. Default value is false.
     *
     * Accepted values: boolean true or false
     */
    'enable_display_name' => true,


    /**
     * Login After Registration
     *
     * Automatically logs the user in after they successfully register. Default
     * value is false.
     *
     * Accepted values: boolean true or false
     */
    //'login_after_registration' => false,

    /**
     * Registration Form Captcha
     *
     * Determines if a captcha should be utilized on the user registration form.
     * Default value is false.
     */
    'use_registration_form_captcha' => true,

    /**
     * Form Captcha Options
     *
     * Currently used for the registration form, but re-usable anywhere. Use
     * this to configure which Zend\Captcha adapter to use, and the options to
     * pass to it. The default uses the Figlet captcha.
     */
    'form_captcha_options' => array(
        'class'   => 'figlet',
        'options' => array(
            'wordLen'    => 5,
            'expiration' => 300,
            'timeout'    => 300,
        ),
    ),

    /**
	 * Sets the view template for the user login widget
	 *
	 * Default value: 'zfc-user/user/login.phtml'
     * Accepted values: string path to a view script
	 */
    //'user_login_widget_view_template' => 'zfc-user/user/login.phtml',

    /**
     * Login Redirect Route
     *
     * Upon successful login the user will be redirected to the entered route
     *
     * Default value: 'zfcuser'
     * Accepted values: A valid route name within your application
     *
     */
    //'login_redirect_route' => 'zfcuser',

    /**
     * Logout Redirect Route
     *
     * Upon logging out the user will be redirected to the enterd route
     *
     * Default value: 'zfcuser/login'
     * Accepted values: A valid route name within your application
     */
    'logout_redirect_route' => 'home',

    /**
     * Enable user state usage
     * 
     * Should user's state be used in the registration/login process?
     */
    'enable_user_state' => true,
    
    /**
     * Default user state upon registration
     * 
     * What state user should have upon registration?
     * Allowed value type: integer
     */
    'default_user_state' => 1,
    
    /**
     * States which are allowing user to login
     * 
     * When user tries to login, is his/her state one of the following?
     * Include null if you want user's with no state to login as well.
     * Allowed value types: null and integer
     */
    'allowed_login_states' => array(1),

);

/**
 * You do not need to edit below this line
 */
return array(
    'zfcuser' => $settings,
    'service_manager' => array(
        'aliases' => array(
            'zfcuser_zend_db_adapter' => (isset($settings['zend_db_adapter'])) ? $settings['zend_db_adapter']: 'Zend\Db\Adapter\Adapter',
        ),
    ),
);
