<?php
/**
 * Classe reliant le formulaire AddRole a l'entité Roles et à la table Roles
 * @author Jonathan Greco <nataniel.greco@gmail.com>
 */
namespace Admin\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class AddRoleFieldset extends Fieldset
{
	public function init()
	{

	}
}