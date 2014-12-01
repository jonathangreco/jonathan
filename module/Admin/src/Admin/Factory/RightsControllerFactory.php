<?php
/**
 * @package Admin
 * @author Jonathan Greco <nataniel.greco@gmail.com>
 */
namespace Admin\Factory;

use Admin\Controller\RightsController;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RightsControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $parentLocator = $serviceLocator->getServiceLocator();
        $rightsService = $parentLocator->get('Admin\Service\RightsService');

        return new RightsController($rightsService);
    }
}
