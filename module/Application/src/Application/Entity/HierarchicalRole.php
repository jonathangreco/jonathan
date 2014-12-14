<?php
/**
 * Classe permettant de gérer les roles par utilisateur, ainsi que leurs groupes.
 * @author Jonathan Greco <nataniel.greco@gmail.com>
 */
namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Rbac\Role\HierarchicalRoleInterface;
use ZfcRbac\Permission\PermissionInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="roles")
 * @ORM\Entity(repositoryClass="Application\Repository\HierarchicalRoleRepository")
 */
class HierarchicalRole implements HierarchicalRoleInterface
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
     * @ORM\Column(type="string", length=48, unique=true)
     */
    protected $name;

    /**
     * @var HierarchicalRoleInterface[]|\Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="HierarchicalRole")
     */
    protected $children;

    /**
     * @var PermissionInterface[]|\Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Permission", indexBy="name", fetch="EAGER", cascade={"persist"})
     */
    protected $permissions;

    /**
     * Init the Doctrine collection
     */
    public function __construct()
    {
        $this->children    = new ArrayCollection();
        $this->permissions = new ArrayCollection();
    }

    /**
     * {@inheritDoc}
     */
    public function addChild(HierarchicalRoleInterface $child)
    {
        $this->children[] = $child;
    }

    /**
     * On ajoute plusieurs role à un role créée
     * @param ArrayCollection $children
     */
    public function addChildren(ArrayCollection $children)
    {
        foreach ($children as $child) {
            $this->addChild($child);
        }
    }


    /**
     * Cette méthode viens avec l'hydrateur doctrine, en gros on check les différence avec les ajout et on opère les suppressions des
     * enfants qui ont été supprimés
     *
     * Problème : ça marche pas vraiment correctement
     * 
     * @param  ArrayCollection $children
     */
    public function removeChildren(ArrayCollection $children)
    {
        foreach ($children as $child) {
            $this->children->clear();
        }
    }

    /*
     * Set the list of permission
     * @param Collection $permissions
     */
    public function setPermissions(ArrayCollection $permissions)
    {
        $this->permissions->clear();
        foreach ($permissions as $permission) {
            $this->permissions[] = $permission;
        }
    }

    /**
     * Cette méthode retourne toutes les permissions d'un role
     * @return Collection Permissions
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * Cette méthode attache une permission, à un role.
     * {@inheritDoc}
     */
    public function addPermission($permission)
    {
        if (is_string($permission)) {
            $permission = new Permission($permission);
        }

        $this->permissions[(string) $permission] = $permission;
    }

    /**
     * {@inheritDoc}
     */
    public function hasPermission($permission)
    {
        // This can be a performance problem if your role has a lot of permissions. Please refer
        // to the cookbook to an elegant way to solve this issue

        return isset($this->permissions[(string) $permission]);
    }

    /**
     * {@inheritDoc}
     */
    public function getChildren()
    {
        return $this->children->toArray();
    }

    /**
     * {@inheritDoc}
     */
    public function hasChildren()
    {
        return !$this->children->isEmpty();
    }

    /**
     * Set the role name
     *
     * @param  string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = (string) $name;
    }

    /**
     * Get the role name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * Gets the value of id.
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param int|null $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
}