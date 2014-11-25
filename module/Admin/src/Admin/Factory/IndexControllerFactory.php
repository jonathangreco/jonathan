<?php
/**
* Factory permettant d'injecter une instance de indexService dans le controller
* 
* @author Jonathan Greco <jgreco@docsourcing.com>
*/
namespace Admin\Factory;

use Doctrine\Common\Persistence\ObjectManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Admin\Controller\IndexController;

class IndexControllerFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$parentLocator = $serviceLocator->getServiceLocator();
		$indexService = $parentLocator->get('Admin\Service\IndexService');

		return new IndexController($indexService);
	}
}