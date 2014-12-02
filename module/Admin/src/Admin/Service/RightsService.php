<?php
/**
 * Couche service de nos droits pour l'application
 * Gestion d'un CRUD complet pour role, permission et user..
 * @author Jonathan Greco <nataniel.greco@gmail.com>
 */
namespace Admin\Service;

use Doctrine\Common\Persistence\ObjectManager;

class RightsService
{
    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
    }
    
    /**
     * On récupère tous nos roles
     */
    public function getRoles()
    {
        return $this->em->getRepository('Application\Entity\HierarchicalRole')->findAll();
    }

    /**
     * On récupère toutes nos permissions
     */
    public function getPermissions()
    {
        return $this->em->getRepository('Application\Entity\Permission')->findAll();
    }
}
