<?php
/**
 * 
 * @package User
 * @author Jonathan Greco <jgreco@docsourcing.com>
 * @author Bastien Hérault <bherault@docsourcing.com>  
 */
 
namespace User\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Doctrine\Common\Persistence\ObjectManager;
//use User\Entity\User;

class UserService implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

}