<?php
/**
 * @package User
 * @author Jonathan Greco <jgreco@docsourcing.com> 
 */
namespace User\Factory;

use User\Controller\UserController;
use User\Service\UserService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $parentLocator = $serviceLocator->getServiceLocator();

        /** @var UserService $UserService */
        $userService = $parentLocator->get('User\Service\User');
        return new UserController($userService);
    }
}
