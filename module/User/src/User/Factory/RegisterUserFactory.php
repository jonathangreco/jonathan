<?php
/**
 * @author Jonathan Greco <nataniel.greco@gmail.com>
 */
namespace User\Factory;

use User\Listener\RegisterUserListener;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RegisterUserFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new RegisterUserListener();
    }
}