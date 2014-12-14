<?php
/**
 * Classe reliant le formulaire AddRole a l'entité Roles et à la table Roles
 * @author Jonathan Greco <nataniel.greco@gmail.com>
 */
namespace Admin\Form\Fieldset;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use DoctrineModule\Persistence\ProvidesObjectManager as ProvidesObjectManagerTrait ;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Application\Entity\HierarchicalRole;

class UpdateRoleFieldset extends Fieldset implements
    ObjectManagerAwareInterface,
    InputFilterProviderInterface
{
    use ProvidesObjectManagerTrait;

	public function init()
	{
        $this->setHydrator(new DoctrineHydrator($this->getObjectManager(), 'Application\Entity\HierarchicalRole'))
            ->setObject(new HierarchicalRole());

        $this->add(
            array(
                'name' => 'name',
                'type' => 'Zend\Form\Element\Text',
                'options' => array(
                    'label' => 'Role\'s name',
                    'comments' => 'How this customer want to regroup his invoices ?'
                ),
                'attributes' => array(
                    'class' => 'form-control',
                ),
            )
        );

        $this->add(
            array(
                'name' => 'children',
                'type' => 'DoctrineModule\Form\Element\ObjectSelect',
                'options' => array(
                    'object_manager' => $this->getObjectManager(),
                    'label' => 'Children',
                    'target_class' => 'Application\Entity\HierarchicalRole',
                    'property' => 'name',
                ),
                'attributes' => array(
                    'multiple' => true,
                    'class' => 'select2 form-control',
                ),
            )
        );
	}

    /**
     * Set requirements for validation 
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return array(
            'role'  => array(
                'required'   => true,
                'filters'    => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
        );

    }
}
