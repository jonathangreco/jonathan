<?php
/**
* Factory permettant d'injecter une instance de indexService dans le controller
* 
* @author Jonathan Greco <nataniel.greco@gmail.com>
*/
namespace Application\Factory;

use Doctrine\Common\Persistence\ObjectManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Controller\IndexController;

class IndexControllerFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$parentLocator = $serviceLocator->getServiceLocator();
		$indexService = $parentLocator->get('Application\Service\IndexService');

		return new IndexController($indexService);
	}
}