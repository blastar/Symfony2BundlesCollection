<?php

namespace Blastar\AdminUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 */
class User implements UserInterface, \Serializable
{
	/**
	 * @var integer
	 */
	private $id;

	/**
	 * @var string
	 */
	private $username;

	/**
	 * @var string
	 */
	private $password;

	/**
	 * @var string
	 */
	private $email;

	/**
	 * @var boolean
	 */
	private $isActive;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $acl;

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
	 * Set username
	 *
	 * @param string $username
	 * @return User
	 */
	public function setUsername($username)
	{
		$this->username = $username;

		return $this;
	}

	/**
	 * Get username
	 *
	 * @return string 
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * Set password
	 *
	 * @param string $password
	 * @return User
	 */
	public function setPassword($password)
	{
		$this->password = $password;

		return $this;
	}

	/**
	 * Get password
	 *
	 * @return string 
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * Set email
	 *
	 * @param string $email
	 * @return User
	 */
	public function setEmail($email)
	{
		$this->email = $email;

		return $this;
	}

	/**
	 * Get email
	 *
	 * @return string 
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Set isActive
	 *
	 * @param boolean $isActive
	 * @return User
	 */
	public function setIsActive($isActive)
	{
		$this->isActive = $isActive;

		return $this;
	}

	/**
	 * Get isActive
	 *
	 * @return boolean 
	 */
	public function getIsActive()
	{
		return $this->isActive;
	}

	public function getSalt()
	{
		// you *may* need a real salt depending on your encoder
		// see section on salt below
		return null;
	}

	public function getRoles()
	{

		return array('ROLE_ADMIN');
	}

	public function eraseCredentials()
	{
		
	}

	/**
	 * @see \Serializable::serialize()
	 */
	public function serialize()
	{
		return serialize(array(
			$this->id,
			$this->username,
			$this->password,
				// see section on salt below
				// $this->salt,
		));
	}

	/**
	 * @see \Serializable::unserialize()
	 */
	public function unserialize($serialized)
	{
		list (
				$this->id,
				$this->username,
				$this->password,
				// see section on salt below
				// $this->salt
				) = unserialize($serialized);
	}

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->acl = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Add acl
	 *
	 * @param \Blastar\AdminUserBundle\Entity\Role $acl
	 * @return User
	 */
	public function addAcl(\Blastar\AdminUserBundle\Entity\Role $acl)
	{
		$this->acl[] = $acl;

		return $this;
	}

	/**
	 * Remove acl
	 *
	 * @param \Blastar\AdminUserBundle\Entity\Role $acl
	 */
	public function removeAcl(\Blastar\AdminUserBundle\Entity\Role $acl)
	{
		$this->acl->removeElement($acl);
	}

	/**
	 * Get acl
	 *
	 * @return \Doctrine\Common\Collections\Collection 
	 */
	public function getAcl()
	{
		return $this->acl;
	}

    /**
     * @var string
     */
    private $salt;


    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }
}
