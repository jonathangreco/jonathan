<?php
/**
 * 
 * @package User
 * @author Jonathan Greco <jgreco@docsourcing.com>  
 */

namespace UserTest\Controller;

use Zend\Http\Request as HttpRequest;
use UserTest\UserBootstrap;
use User\Controller\UserController;
use User\Service\UserService;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class UserControllerTest extends AbstractHttpControllerTestCase {

    public function setUp()
    {
        $this->setApplicationConfig(
           include __DIR__ . '../../../../../Application/tests/TestConfig.php.dist'
        );
        parent::setUp();
    }

    public function testIndexActionCanBeAccessed()
    {
        $this->dispatch('/user');
        $this->assertMatchedRouteName('User');
        $this->assertControllerName('User\Controller\User');
        $this->assertControllerClass('UserController');
        $this->assertModuleName('User');
    }
}