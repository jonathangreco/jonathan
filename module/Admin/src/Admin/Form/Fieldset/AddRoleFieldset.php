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
        $this->setHydrator(new DoctrineHydrator($this->getObjectManager(), 'Application\Entity\HierarchicalRole'))
            ->setObject(new HierarchicalRole());

        /**
         * Sample of config fieldset
         * 
         * 
         * 
         */
        $this->add(
            array(
                'name' => 'idConfig',
                'attributes' => array(
                    'type' => 'hidden',
                ),
            )
        );

        $this->add(
            array(
                'name'    => 'regroupMode',
                'type' => 'Zend\Form\Element\Select',
                'options' => array(
                    'label' => 'Regroup Mode',
                    'value_options' => array(
                        'equal' => '1 invoice, 1 order',
                        'imputation' => 'Imputation',
                        'groupBy' => 'Group by',
                    ),
                    'comments' => 'How this customer want to regroup his invoices ?'
                ),
                'attributes' => array(
                    'data-field' => 'groupBySelect',
                    'data-expected' => 'groupBy',
                    'class' => 'showField',
                ),
            )
        );

        $this->add(
            array(
                'name'    => 'groupBySelect',
                'type' => 'Zend\Form\Element\Select',
                'options' => array(
                    'label' => 'Group by value',
                    'value_options' => array(
                        'item' => 'Item',
                        'refentcli' => 'Reference customer',
                    ),
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
            'idConfig' => array(
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ),
            'regroupMode'  => array(
                'required'   => true,
                'filters'    => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
            'groupBySelect'  => array(
                'required'   => false,
                'filters'    => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
        );

    }
}
