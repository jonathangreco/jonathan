<?php
/**
 * Classe largement inspiré du module ZfcAdmin pour offrir une interface différente de notre
 * backend
 */

namespace Admin;

use Zend\ModuleManager\Feature;
use Zend\Loader;
use Zend\EventManager\EventInterface;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;

class Module implements 
    Feature\AutoloaderProviderInterface,
    Feature\ConfigProviderInterface,
    Feature\ServiceProviderInterface,
    Feature\BootstrapListenerInterface
{
    public function onBootstrap(EventInterface $e)
    {
        $app = $e->getParam('application');
        $em = $app->getEventManager();
        $em->attach(MvcEvent::EVENT_DISPATCH, array($this, 'selectLayoutBasedOnRoute'));
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * Méthode permettant de selectionner un layout basé sur la route
     * @param  MvcEvent $e [description]
     * @return [type]      [description]
     */
    public function selectLayoutBasedOnRoute(MvcEvent $e)
    {
        $app = $e->getParam('application');
        $sm = $app->getServiceManager();
        $config = $sm->get('config');
        if (false === $config['jonathan_admin']['use_admin_layout']) {
            return;
        }
        $match = $e->getRouteMatch();
        $controller = $e->getTarget();
        if (!$match instanceof RouteMatch
            || 0 !== strpos($match->getMatchedRouteName(), 'backoffice')
            || $controller->getEvent()->getResult()->terminate()
        ) {
            return;
        }
        $layout = $config['jonathan_admin']['admin_layout_template'];
        $controller->layout($layout);
    }

    public function getAutoloaderConfig()
    {
        return array(
            Loader\AutoloaderFactory::STANDARD_AUTOLOADER => array(
                Loader\StandardAutoloader::LOAD_NS => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * On implemente cette méthode juste parcequ'on implémente une interface qui l'impose
     * @return array
     */
    public function getServiceConfig()
    {
        return array();
    }

    /**
     * Permet d'injecter à l'interface ObjectManagerAwareInterface, l'entityManager pour les formulaires
     */
    public function getFormElementConfig()
    {
        return array(
            'initializers' => array(
                'ObjectManagerInitializer' => function ($element, $formElements) {
                    if ($element instanceof ObjectManagerAwareInterface) {
                        $services      = $formElements->getServiceLocator();
                        $entityManager = $services->get('Doctrine\ORM\EntityManager');

                        $element->setObjectManager($entityManager);
                    }
                },
            ),
        );
    }
}
