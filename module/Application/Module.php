<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Controller\Plugin\FlashMessenger;
use Zend\Session\Container;
use Zend\I18n\Translator\Translator;
use Zend\Validator\AbstractValidator;
use Zend\Http\Response;
use Application\View\Helper\AbsoluteUrl;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        // container de session
        $sessionContainer = new Container('locale');
        // teste si la langue en session existe
        if(!$sessionContainer->offsetExists('mylocale')){
            $sessionContainer->offsetSet('mylocale', 'fr_FR');
        }
        // mise en place du service de traduction
        $translator = $e->getApplication()->getServiceManager()->get('translator');
        $translator->setLocale($sessionContainer->mylocale)->setFallbackLocale('en_US');

        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $FlashMessenger = $e->getApplication()->getServiceManager()->get('FlashMessageListener');
        $FlashMessenger->attach($eventManager);

        /**
         * On utilise un listener pour charger une navigation selon les permissions
         */
        $rbacListener = $e->getApplication()->getServiceManager()->get('Application\Listener\AuthorizationListener');
        $eventManager->getSharedManager()->attach(
            'Zend\View\Helper\Navigation\AbstractHelper',
            'isAllowed',
            array($rbacListener, 'accept')
        );

        /**
         * On utilise le gestionnaire d'evennement pour attacher au module d'enregistrement d'utilisateur le role user a chaque new user
         */
        $registerUserListener = $e->getApplication()->getServiceManager()->get('Application\Listener\RegisterUserListener');
        $registerUserListener->attach($eventManager);
        
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
            // the array key here is the name you will call the view helper by in your view scripts
                'absoluteUrl' => function($sm) {
                    $locator = $sm->getServiceLocator(); // $sm is the view helper manager, so we need to fetch the main service manager
                    return new AbsoluteUrl($locator->get('Request'));
                },
            ),
        );
    }
}
