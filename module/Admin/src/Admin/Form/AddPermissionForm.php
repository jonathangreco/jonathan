<?php
/**
 * Classe permettant de créer un formulaire d'ajout de role en BDD
 * @author Jonathan Greco <nataniel.greco@gmail.com>
 */
namespace Admin\Form;

use Zend\Form\Form;

class AddPermissionForm extends Form
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
                'name' => 'add_perm_csrf',
                'options' => array(
                    'csrf_options' => array(
                        'timeout' => 300,
                        'message' => 'This form is valid for 300 seconds, time expired, please re-validate the form',
                    )
                )
            )
        );

        $this->add(
            array(
                'type'    => 'Admin\Form\Fieldset\AddPermFieldset',
                'options' => array(
                    'use_as_base_fieldset' => true,
                )
            )
        );


        $this->setValidationGroup(array(
            'add_perm_csrf',
            'permissionFieldset' => array(
                'name',
            ),
        ));

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