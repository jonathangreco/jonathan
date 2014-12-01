<?php
/**
 * @package Admin
 * @author Jonathan Greco <nataniel.greco@gmail.com>
 */
namespace Admin\Factory;

use Admin\Service\RightsService;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RightsServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var ObjectManager $objectManager */
        $objectManager = $serviceLocator->get('doctrine.entitymanager.orm_default');
        return new RightsService($objectManager);
    }
}
