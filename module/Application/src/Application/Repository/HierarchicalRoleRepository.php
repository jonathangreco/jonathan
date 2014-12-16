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
	 * Sur le principe ça marche bien, reste plus qu'a trouver commer passer une valeur dynamique au Fieldset
	 * @param  integer $roleID
	 * @return Query
	 */
	public function findAllExeptOne($roleID = 6)
	{
		$query = $this->createQueryBuilder('r');
		$query->select('r')->where($query->expr()->notIn('r.id', $roleID));
		return $query->getQuery()->getResult();
	}

	public function findAllAlreadyAttached()
	{
		$query = $this->getEntityManager()->createQueryBuilder('p');
		$query->select('p')
			->from('Application\Entity\HierarchicalRole', 'p');
		return $query->getQuery()->getResult();
	}
}