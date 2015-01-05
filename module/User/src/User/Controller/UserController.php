<?php
/**
 * 
 * @package User
 * @author Jonathan Greco <jgreco@docsourcing.com>
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
    private $user;

    public function __construct(UserService $userService)
    {
        $this->user = $userService;
    }

    public function accountUserAction()
    {
        return new ViewModel(array('test' => 'MyAccount'));
    }
}