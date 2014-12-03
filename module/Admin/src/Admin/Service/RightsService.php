<?php
/**
 * Couche service de nos droits pour l'application
 * Gestion d'un CRUD complet pour role, permission et user..
 * @author Jonathan Greco <nataniel.greco@gmail.com>
 */
namespace Admin\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Application\Entity\HierarchicalRole;

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
     * On récupère un role précis
     * @param  integer $id
     * @return HierarchicalRole instance
     */
    public function getRole($id)
    {
        return $this->em->getRepository('Application\Entity\HierarchicalRole')->find($id);
    }

    /**
     * On récupère toutes nos permissions
     */
    public function getPermissions()
    {
        return $this->em->getRepository('Application\Entity\Permission')->findAll();
    }

    public function addRole(HierarchicalRole $role)
    {
        $this->em->persist($role);
        $this->em->flush($role);
    }

    public function deleteRole(HierarchicalRole $role)
    {
        $this->em->remove($role);
        $this->em->flush($role);
    }
}
