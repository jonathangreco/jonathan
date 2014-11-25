<?php
/**
 *
 * @author Remi THOMAS
 */
 
namespace Application\Controller;
 
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
 
class TranslatorController extends AbstractActionController
{
    /**
    *
    * @return \Zend\View\Model\ViewModel
    */
    public function changelocaleAction(){

    // disable layout
    $result = new ViewModel();
    $result->setTerminal(true);

    // variables
    $event = $this->getEvent();
    $matches = $event->getRouteMatch();
    $myLocale = $matches->getParam('locale');
    $redirect = $matches->getParam('redirecturl', '');

    // translate
    $sessionContainer = new Container('locale');

    switch ($myLocale){
	    case 'fr_FR':
	    break;
	    case 'en_US':
	    break;
	    default :
	    $myLocale = 'en_US';
    }

    $sessionContainer->offsetSet('mylocale', $myLocale);

    // redirect
    switch ($redirect){
	    case '':
	    $this->redirect()->toRoute('home');
	    break;
	    default :
	    $this->redirect()->toUrl(urldecode($redirect));
    }

    return $result;
    }
}
