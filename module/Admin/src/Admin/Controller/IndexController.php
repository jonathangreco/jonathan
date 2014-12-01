<?php
/**
 * Controlleur admin gérant une interface de connexion
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Service\IndexService;

class IndexController extends AbstractActionController
{
    public function __construct(IndexService $indexService)
    {
    	$this->indexService = $indexService;
    }

    public function indexAction()
    {
    	$news = $this->indexService->getNews();
    	$view = new ViewModel(array('news' => $news));
        return $view;
    }
}
