<?php

namespace Blastar\AdminUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 */
class Role
{
	/**
	 * @var integer
	 */
	private $id;

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var string
	 */
	private $ident;

	/**
	 * Get id
	 *
	 * @return integer 
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set name
	 *
	 * @param string $name
	 * @return Role
	 */
	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * Get name
	 *
	 * @return string 
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set ident
	 *
	 * @param string $ident
	 * @return Role
	 */
	public function setIdent($ident)
	{
		$this->ident = $ident;

		return $this;
	}

	/**
	 * Get ident
	 *
	 * @return string 
	 */
	public function getIdent()
	{
		return $this->ident;
	}

    /**
     * @var string
     */
    private $route;


    /**
     * Set route
     *
     * @param string $route
     * @return Role
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return string 
     */
    public function getRoute()
    {
        return $this->route;
    }
}
