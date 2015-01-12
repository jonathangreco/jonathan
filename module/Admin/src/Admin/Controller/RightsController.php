<?php
/**
 * Controlleur admin gérant les droits
 * @author Jonathan Greco <nataniel.greco@gmail.com>
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Service\RightsService;

class RightsController extends AbstractActionController
{
    public function __construct(RightsService $rights)
    {
        $this->rights = $rights;
    }

    /**
     * Notre page CRUD du module
     */
    public function indexAction()
    {
        $view = new ViewModel();
        $view->setVariable('roles', $this->rights->getRoles());
        return $view;
    }

    /**
     * Notre action d'update
     */
    public function updateRoleAction()
    {
        $view = new ViewModel();
        
        $request = $this->getRequest();
        
        $form = $this->getServiceLocator()->get('formElementManager')->get('Admin\Form\UpdateRole');
        $fieldset = $this->getServiceLocator()->get('formElementManager')->get('Admin\Form\Fieldset\AddFieldset');
        $fieldset->setUseAsBaseFieldset(true);

        $id = $this->params('id');

        /**
         * Notre méthode initBis pour afficher le champ de formulaire correctement. sans le role dont il est question de
         * mettre à jour 
         */
        $fieldset->initBis($id);
        $form->add($fieldset, array('name' => 'updateRole'));

        $role = $this->rights->getRole($id);
        $form->bind($role);

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->flashMessenger()->setNamespace('success')->addMessage('Your role has been updated');
                $role = $form->getData();
                $this->rights->updateRole($role);
                return $this->redirect()->toRoute('backoffice/rights');
            }
            $this->flashMessenger()->setNamespace('danger')
                 ->addMessage('An error occured please check informations below fields form more informations.');
        }
        $view->setVariable('form', $form);
        $view->setVariable('id', $id);
        return $view;
    }

    /**
     * Notre action d'ajout ne marche que pour l'ajout de role présentement...
     */
    public function addRoleAction()
    {
        $view = new ViewModel();
        /**
         * Le mieux serait de faire l'appel au formulaire dans la couche service ou via un trait
         * Plus propre
         */
        $form = $this->getServiceLocator()->get('formElementManager')->get('Admin\Form\AddRole');
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->flashMessenger()->setNamespace('success')->addMessage('Your role has been registered');
                $role = $form->getData();
                $this->rights->addRole($role);
                return $this->redirect()->toRoute('backoffice/rights');
            }
            $this->flashMessenger()->setNamespace('danger')
                 ->addMessage('An error occured please check informations below fields form more informations.');
        }
        $view->setVariable('form', $form);
        return $view;
    }

    /**
     * Notre action de Supression
     */
    public function deleteRoleAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);
        $role = $this->rights->getRole($id);
        if ($role) {
            $this->rights->deleteRole($role);
            $this->flashMessenger()->setNamespace('success')->addMessage('Your role has been deleted');
        }
        return $this->redirect()->toRoute('backoffice/rights');
    }

    public function addPermissionAction()
    {
        $view = new ViewModel();

        $form = $this->getServiceLocator()->get('formElementManager')->get('Admin\Form\AddPermission');
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            var_dump($request->getPost(),$form->isValid());exit;
            if ($form->isValid()) {
                $this->flashMessenger()->setNamespace('success')->addMessage('Your permission has been registered');
                $permission = $form->getData();
                $this->rights->addPermission($permission);
                return $this->redirect()->toRoute('backoffice/rights');
            }
            $this->flashMessenger()->setNamespace('danger')
                 ->addMessage('An error occured please check informations below fields form more informations.');
        }
        $view->setVariable('form', $form);
        return $view;
    }
}
