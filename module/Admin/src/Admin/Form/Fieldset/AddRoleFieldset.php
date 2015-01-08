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

class AddRoleFieldset extends Fieldset implements
    ObjectManagerAwareInterface,
    InputFilterProviderInterface
{
    use ProvidesObjectManagerTrait;

    public function init()
    {

    }

	public function initBis($roleID)
	{
        $this->setHydrator(new DoctrineHydrator($this->getObjectManager(), 'Application\Entity\HierarchicalRole'))
            ->setObject(new HierarchicalRole());

        $this->add(
             array(
                'name' => 'id',
                'type' => 'hidden',
            )
        );

        $this->add(
            array(
                'name' => 'name',
                'type' => 'Zend\Form\Element\Text',
                'options' => array(
                    'label' => 'Role\'s name',
                    'comments' => 'Role name'
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
                    'is_method'      => true,
                    'find_method'    => array(
                        'name'   => 'findAllExeptOne',
                        'params' => array(
                            'roleID' => $roleID,
                        ),
                    )
                ),
                'attributes' => array(
                    'multiple' => true,
                    'class' => 'select2 form-control',
                ),
            )
        );

        $this->add(
            array(
                'name' => 'permissions',
                'type' => 'DoctrineModule\Form\Element\ObjectSelect',
                'options' => array(
                    'object_manager' => $this->getObjectManager(),
                    'label' => 'Permissions',
                    'target_class' => 'Application\Entity\Permission',
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
            'name'  => array(
                'required'   => true,
                'filters'    => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
            'children'  => array(
                'required'   => true,
                'filters'    => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
            'permissions'  => array(
                'required'   => true,
                'filters'    => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
        );

    }
}
