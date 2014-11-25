<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
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
