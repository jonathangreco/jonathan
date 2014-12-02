<?php
/**
 * @author Jonathan Greco <nataniel.greco@gmail.com>
 */
namespace Admin\Service;

use Doctrine\Common\Persistence\ObjectManager;

class IndexService
{
	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}
    
	public function getNews()
	{
		return $this->em->getRepository('Application\Entity\News')->findAll();
	}
}