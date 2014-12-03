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
        $view->setVariable(
            'collection',
            array(
                'roles' => $this->rights->getRoles(),
                'permissions' => $this->rights->getPermissions()
            )
        );
        return $view;
    }

    /**
     * Notre action d'update
     */
    public function updateAction()
    {
        $type = $this->params('type');
        $id = $this->params('id');
        var_dump($type, $id);
        //$this->user->update();
    }

    /**
     * Notre action d'ajout ne marche que pour l'ajout de role présentement...
     */
    public function addAction()
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
                return $this->redirect()->toRoute('backend/rights');
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
    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);
        $role = $this->rights->getRole($id);
        if ($role) {
            $this->rights->deleteRole($role);
            $this->flashMessenger()->setNamespace('success')->addMessage('Your role has been deleted');
        }
        return $this->redirect()->toRoute('backend/rights');
    }
}
