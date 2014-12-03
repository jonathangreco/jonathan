<?php
/**
 * Classe permettant de créer un formulaire d'ajout de role en BDD
 * @author Jonathan Greco <nataniel.greco@gmail.com>
 */
namespace Admin\Form;

use Zend\Form\Form;
use Doctrine\ORM\EntityManager;

class AddRoleForm extends Form
{
    public function init()
    {
        /**
         * Champ csrf pour le formulaire, au dela du timetout en seconde défini ici, le formulaire renverra une erreur
         * car le token de validation aura expiré..
         */
        $this->add(
            array(
                'type' => 'Zend\Form\Element\Csrf',
                'name' => 'add_role_csrf',
                'options' => array(
                    'csrf_options' => array(
                        'timeout' => 300,
                        'message' => 'This form is valid for 300 seconds, time expired, please re-validate the form',
                    )
                )
            )
        );

        /**
         * Fieldset pour le formulaire d'update config d'un client
         */
        $this->add(
            array(
                'name'    => 'addRole',
                'type'    => 'Admin\Form\Fieldset\AddRoleFieldset',
                'options' => array(
                    'use_as_base_fieldset' => true,
                )
            )
        );

        /**
         * Filtre de validation pour les formulaires
         */
        $this->setValidationGroup(
            array(
                'addRole' => array(
                    'regroupMode',
                    'groupBySelect',
                ),
                'add_config_csrf'
            )
        );

        /**
         * Bouton de validation pour le formulaire update
         */
        $this->add(
            array(
                'name'       => 'submitAdd',
                'attributes' => array(
                    'type'   => 'Submit',
                    'value'  => 'Add',
                    'id'     => 'submitbutton',
                ),
            )
        );
    }
}