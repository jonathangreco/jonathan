<?php
/**
* Ce Listener permet de construire un tableau de FlashMessage selon les namespaces.
* Danger | Info | Warning | Success
* Il est appelé après chaque chargement de page tant qu'il y a des Flash Message à afficher
*/
namespace Application\Listener;

use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Controller\Plugin\FlashMessenger;

class FlashMessageListener implements ListenerAggregateInterface
{
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_RENDER, array($this, 'getFlashMessage'));
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function getFlashMessage(EventInterface $e)
    {
        $flashMessenger = new FlashMessenger;
        $messages = array();
        $flashMessenger->setNamespace('success');

        if ($flashMessenger->hasMessages()) {
            $messages['success'] = $flashMessenger->getMessages();
        }

        $flashMessenger->clearMessages();
        $flashMessenger->setNamespace('warning');

        if ($flashMessenger->hasMessages()) {
            $messages['warning'] = $flashMessenger->getMessages();
        }

        $flashMessenger->clearMessages();
        $flashMessenger->setNamespace('info');

        if ($flashMessenger->hasMessages()) {
            $messages['info'] = $flashMessenger->getMessages();
        }

        $flashMessenger->clearMessages();
        $flashMessenger->setNamespace('default');
        if ($flashMessenger->hasMessages()) {
            if (isset($messages['info'])) {
                $messages['info'] = array_merge($messages['info'], $flashMessenger->getMessages());
            }
            else {
                $messages['info'] = $flashMessenger->getMessages();
            }
        }
        $flashMessenger->clearMessages();
        $flashMessenger->setNamespace('danger');
        if ($flashMessenger->hasMessages()) {
            $messages['danger'] = $flashMessenger->getMessages();
        }
        $flashMessenger->clearMessages();
        $e->getViewModel()->setVariable('flashMessages', $messages);
    }
}
