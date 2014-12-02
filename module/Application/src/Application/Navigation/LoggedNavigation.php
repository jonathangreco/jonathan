<?php
/**
 * @author Jonathan Greco <nataniel.greco@gmail.com>
 */
namespace Application\Navigation;

use Zend\Navigation\Service\DefaultNavigationFactory;

/**
 * Factory for the admin navigation
 */
class LoggedNavigation extends DefaultNavigationFactory
{
	/**
	* @{inheritdoc}
	*/
	protected function getName()
	{
		return 'logged';
	}
}