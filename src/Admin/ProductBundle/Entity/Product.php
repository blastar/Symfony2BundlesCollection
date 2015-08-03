<?php

namespace Admin\ProductBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Product
 */
class Product
{
	/**
	 * @var integer
	 */
	protected $id;

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var string
	 */
	protected $descriptionShort;

	/**
	 * @var string
	 */
	protected $description;

	/**
	 * @var DateTime
	 */
	protected $dateAdded;

	/**
	 * @var DateTime
	 */
	protected $dateModified;

	/**
	 * @var Collection
	 */
	protected $categories;

	/**
	 * @var Collection
	 */
	protected $prices;

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
	 * @return Product
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
	 * Set descriptionShort
	 *
	 * @param string $descriptionShort
	 * @return Product
	 */
	public function setDescriptionShort($descriptionShort)
	{
		$this->descriptionShort = $descriptionShort;

		return $this;
	}

	/**
	 * Get descriptionShort
	 *
	 * @return string 
	 */
	public function getDescriptionShort()
	{
		return $this->descriptionShort;
	}

	/**
	 * Set description
	 *
	 * @param string $description
	 * @return Product
	 */
	public function setDescription($description)
	{
		$this->description = $description;

		return $this;
	}

	/**
	 * Get description
	 *
	 * @return string 
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Set dateAdded
	 *
	 * @param DateTime $dateAdded
	 * @return Product
	 */
	public function setDateAdded($dateAdded)
	{
		$this->dateAdded = $dateAdded;

		return $this;
	}

	/**
	 * Get dateAdded
	 *
	 * @return DateTime 
	 */
	public function getDateAdded()
	{
		return $this->dateAdded;
	}

	/**
	 * Set dateModified
	 *
	 * @param DateTime $dateModified
	 * @return Product
	 */
	public function setDateModified($dateModified)
	{
		$this->dateModified = $dateModified;

		return $this;
	}

	/**
	 * Get dateModified
	 *
	 * @return DateTime 
	 */
	public function getDateModified()
	{
		return $this->dateModified;
	}

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->categories = new ArrayCollection();
		$this->prices = new ArrayCollection();
	}

	/**
	 * Add categories
	 *
	 * @param ProductCategory $categories
	 * @return Product
	 */
	public function addCategory(ProductCategory $categories)
	{
		$this->categories[] = $categories;

		return $this;
	}

	/**
	 * Remove categories
	 *
	 * @param ProductCategory $categories
	 */
	public function removeCategory(ProductCategory $categories)
	{
		$this->categories->removeElement($categories);
	}

	/**
	 * Get categories
	 *
	 * @return Collection 
	 */
	public function getCategories()
	{
		return $this->categories;
	}

	/**
	 * Add prices
	 *
	 * @param ProductPrice $prices
	 * @return Product
	 */
	public function addPrice(ProductPrice $prices)
	{
		$this->prices[] = $prices;

		return $this;
	}

	/**
	 * Remove prices
	 *
	 * @param ProductPrice $prices
	 */
	public function removePrice(ProductPrice $prices)
	{
		$this->prices->removeElement($prices);
	}

	/**
	 * Get prices
	 *
	 * @return Collection 
	 */
	public function getPrices()
	{
		return $this->prices;
	}

}