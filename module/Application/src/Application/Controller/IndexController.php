<?php
/**
 * @author Jonathan Greco <nataniel.greco@gmail.com>
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Service\IndexService;

class IndexController extends AbstractActionController
{
    public function __construct(IndexService $indexService) {
    	$this->indexService = $indexService;
    }

    public function indexAction()
    {
    	$news = $this->indexService->getNews();
        return new ViewModel(array('news' => $news));
    }
}
