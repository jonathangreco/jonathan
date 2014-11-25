<?php
/**
* @package Application
* @author Jonathan Greco <nataniel.greco@gmail.com>
*/
namespace Application\View\Helper;

use Zend\Http\Request;
use Zend\View\Helper\AbstractHelper;

class AbsoluteUrl extends AbstractHelper
{
	protected $request;
	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function __invoke()
	{
		return $this->request->getUri()->normalize();
	}
}
