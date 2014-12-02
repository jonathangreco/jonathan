<?php
/**
 * @author Jonathan Greco <nataniel.greco@gmail.com>
 */
namespace User\Listener;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\Event;

class RegisterUserListener extends AbstractListenerAggregate
{
    public function attach(EventManagerInterface $events)
    {
        $sharedManager = $events->getSharedManager();
        $this->listeners[] = $sharedManager->attach('ZfcUser\Service\User', 'register', array($this, 'onRegister'));
        $this->listeners[] = $sharedManager->attach('ZfcUser\Service\User', 'register.post', array($this, 'onRegisterPost'));
    }

    public function onRegister(Event $e)
    {
        $sm = $e->getTarget()->getServiceManager();
        $em = $sm->get('doctrine.entitymanager.orm_default');
        $user = $e->getParam('user');
        $config = $sm->get('config');
        $criteria = array('name' => $config['zfcuser']['new_user_default_role']);
        $defaultUserRole = $em->getRepository('Application\Entity\HierarchicalRole')->findOneBy($criteria);

        if ($defaultUserRole !== null)
        {
            $user->addRole($defaultUserRole);
        }
    }

    public function onRegisterPost(Event $e)
    {
        $user = $e->getParam('user');
        $form = $e->getParam('form');
        /**
         *
         * On peut faire plus de job ici
         */
    }
}