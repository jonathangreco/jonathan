<?php
/**
 * @package Application
 * @author Jonathan Greco <nataniel.greco@gmail.com>
 */
namespace Application\Factory;

use Application\Service\IndexService;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IndexServiceFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		/** @var ObjectManager $objectManager */
		$objectManager = $serviceLocator->get('doctrine.entitymanager.orm_default');
		return new IndexService($objectManager);
	}
}
