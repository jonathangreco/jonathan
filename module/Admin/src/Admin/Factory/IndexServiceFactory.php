<?php
/**
 * @package Admin
 * @author Jonathan Greco <nataniel.greco@gmail.com>
 */
namespace Admin\Factory;

use Admin\Service\IndexService;
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
