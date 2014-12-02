<?php
/**
 * @author Jonathan Greco <nataniel.greco@gmail.com>
 */
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use ZfcRbac\Permission\PermissionInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="permissions")
 */
class Permission implements PermissionInterface
{
    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=128, unique=true)
     */
    protected $name;

    /**
     * Constructor
     */
    public function __construct($name)
    {
        $this->name  = (string) $name;
    }

    /**
     * Get the permission identifier
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Gets the value of name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the value of name.
     *
     * @param string|null $name the name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
