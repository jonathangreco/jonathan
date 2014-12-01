<?php
/**
 * @extends PHPUnit_Framework_TestCase
 * Permet de récupérer l'entity Manager en utilisant la factory et de faire d'autres actions
 * Accessible dans nos classe de test ! On factorise l'accès à l'EntityManager
 * @package User
 * @author Jonathan Greco <jgreco@docsourcing.com>  
 */


namespace UserTest\Framework;

use PHPUnit_Framework_TestCase;
use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\ServiceManager;
use UserTest\Util\ServiceManagerFactory;

class TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * Get EntityManager.
     *
     * @return EntityManager
     */
    public function getEntityManager()
    {
        if ($this->entityManager) {
            return $this->entityManager;
        }

        $serviceManager = ServiceManagerFactory::getServiceManager();
        $serviceManager->get('doctrine.entity_resolver.orm_default');
        $this->entityManager = $serviceManager->get('doctrine.entitymanager.mylinkun');

        return $this->entityManager;
    }
}