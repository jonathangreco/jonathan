<?php
/**
 * Controlleur admin gérant une interface de connexion
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    public function indexAction()
    {
        return $view;
    }

    public function accountUserAction()
    {
    	return new ViewModel(array('test' => 'MyAccount'));
    }
}
