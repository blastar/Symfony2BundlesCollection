<?php

namespace Blastar\AdminCategoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 */
class Category
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
	 * @var integer
	 */
	private $lft;

	/**
	 * @var integer
	 */
	private $level;

	/**
	 * @var integer
	 */
	private $rgt;

	/**
	 * @var integer
	 */
	private $root;

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
	 * @return Category
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
	 * Set lft
	 *
	 * @param integer $lft
	 * @return Category
	 */
	public function setLft($lft)
	{
		$this->lft = $lft;

		return $this;
	}

	/**
	 * Get lft
	 *
	 * @return integer 
	 */
	public function getLft()
	{
		return $this->lft;
	}

	/**
	 * Set level
	 *
	 * @param integer $level
	 * @return Category
	 */
	public function setLevel($level)
	{
		$this->level = $level;

		return $this;
	}

	/**
	 * Get level
	 *
	 * @return integer 
	 */
	public function getLevel()
	{
		return $this->level;
	}

	/**
	 * Set rgt
	 *
	 * @param integer $rgt
	 * @return Category
	 */
	public function setRgt($rgt)
	{
		$this->rgt = $rgt;

		return $this;
	}

	/**
	 * Get rgt
	 *
	 * @return integer 
	 */
	public function getRgt()
	{
		return $this->rgt;
	}

	/**
	 * Set root
	 *
	 * @param integer $root
	 * @return Category
	 */
	public function setRoot($root)
	{
		$this->root = $root;

		return $this;
	}

	/**
	 * Get root
	 *
	 * @return integer 
	 */
	public function getRoot()
	{
		return $this->root;
	}

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $children;

	/**
	 * @var \Blastar\AdminCategoryBundle\Entity\Category
	 */
	private $parent;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->children = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Add children
	 *
	 * @param \Blastar\AdminCategoryBundle\Entity\Category $children
	 * @return Category
	 */
	public function addChild(\Blastar\AdminCategoryBundle\Entity\Category $children)
	{
		$this->children[] = $children;

		return $this;
	}

	/**
	 * Remove children
	 *
	 * @param \Blastar\AdminCategoryBundle\Entity\Category $children
	 */
	public function removeChild(\Blastar\AdminCategoryBundle\Entity\Category $children)
	{
		$this->children->removeElement($children);
	}

	/**
	 * Get children
	 *
	 * @return \Doctrine\Common\Collections\Collection 
	 */
	public function getChildren()
	{
		return $this->children;
	}

	/**
	 * Set parent
	 *
	 * @param \Blastar\AdminCategoryBundle\Entity\Category $parent
	 * @return Category
	 */
	public function setParent(\Blastar\AdminCategoryBundle\Entity\Category $parent = null)
	{
		$this->parent = $parent;

		return $this;
	}

	/**
	 * Get parent
	 *
	 * @return \Blastar\AdminCategoryBundle\Entity\Category 
	 */
	public function getParent()
	{
		return $this->parent;
	}

}