<?php
/**
 * 
 * @package User
 * @author Jonathan Greco <nataniel.greco@gmail.com>
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