<?php
/**
 * 
 * @package User
 * @author Jonathan Greco <jgreco@docsourcing.com>  
 * @author Bastien Hérault <bherault@docsourcing.com>  
 */
 
namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
//use User\Entity\User;
use User\Service\UserService;

class UserController extends AbstractActionController
{
    /**
     * @var User\Service\UserService
     */ 
    private $User;

    public function __construct(UserService $UserService)
    {
        $this->User = $UserService;
    }

    public function accountUserAction()
    {
        return new ViewModel(array('test' => 'MyAccount'));
    }
}