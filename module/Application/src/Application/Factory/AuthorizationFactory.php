<?php
/**
 * @author Jonathan Greco <nataniel.greco@gmail.com>
 */

namespace Application\Factory;


use Application\Listener\AuthorizationListener;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AuthorizationFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $authorizationService = $serviceLocator->get('ZfcRbac\Service\AuthorizationService');

        return new AuthorizationListener($authorizationService);
    }
}