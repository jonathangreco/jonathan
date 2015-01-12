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
use Application\Entity\Permission;

class AddPermFieldset extends Fieldset implements
    ObjectManagerAwareInterface,
    InputFilterProviderInterface
{
    use ProvidesObjectManagerTrait;

    public function __construct()
    {
    	parent::__construct('permissionFieldset');
    }
    
    public function init()
    {
        $this->setHydrator(new DoctrineHydrator($this->getObjectManager(), 'Application\Entity\Permission'))
            ->setObject(new Permission());

        $this->add(
            array(
                'name' => 'name',
                'type' => 'Zend\Form\Element\Text',
                'options' => array(
                    'label' => 'Permission\'s name',
                    'comments' => 'Permission name'
                ),
                'attributes' => array(
                    'class' => 'form-control',
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
        );
    }
}
