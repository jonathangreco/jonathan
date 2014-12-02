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
     * Notre action d'ajout
     */
    public function addAction()
    {

    }

    /**
     * Notre action de Supression
     */
    public function deleteAction()
    {

    }
}
