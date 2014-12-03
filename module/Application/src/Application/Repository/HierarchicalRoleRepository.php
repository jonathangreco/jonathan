<?php
/**
 * Classe permettant de customiser certaines méthodes de l'entité Role
 * @author Jonathan Greco <nataniel.greco@gmail.com>
 */
namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Application\Entity\HierarchicalRole;

class HierarchicalRoleRepository extends EntityRepository
{
	/**
	 * Permet de récupérer les permissions associé à un role
	 * @param  HierarchicalRole $role
	 * @return array de Permissions
	 */
	public function getPermissionForRole(HierarchicalRole $role)
	{

	}
}