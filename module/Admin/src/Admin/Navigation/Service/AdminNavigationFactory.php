<?php
namespace Admin\Navigation\Service;

use Zend\Navigation\Service\DefaultNavigationFactory;

/**
 * Factory for the admin navigation
 */
class AdminNavigationFactory extends DefaultNavigationFactory
{
	/**
	* @{inheritdoc}
	*/
	protected function getName()
	{
		return 'admin';
	}
}