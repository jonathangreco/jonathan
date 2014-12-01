<?php
/**
 * Controlleur admin gérant les droits
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

    public function indexAction()
    {
        $view = new ViewModel();
        $view->setVariable('rights', $this->rights->getRoles());
        $view->setVariable('permissions', $this->rights->getPermissions());
        return $view;
    }

    public function updateAction()
    {

    } 
}
