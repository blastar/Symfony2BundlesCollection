<?php

namespace Admin\ProductBundle\Entity;

/**
 * ProductCategory
 */
class ProductCategory
{
	/**
	 * @var integer
	 */
	protected $id;

	/**
	 * @var string
	 */
	protected $cat;

	/**
	 * @var Product
	 */
	protected $product;

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
	 * Set cat
	 *
	 * @param string $cat
	 * @return ProductCategory
	 */
	public function setCat($cat)
	{
		$this->cat = $cat;

		return $this;
	}

	/**
	 * Get cat
	 *
	 * @return string 
	 */
	public function getCat()
	{
		return $this->cat;
	}

	/**
	 * Set product
	 *
	 * @param Product $product
	 * @return ProductCategory
	 */
	public function setProduct(Product $product = null)
	{
		$this->product = $product;

		return $this;
	}

	/**
	 * Get product
	 *
	 * @return Product 
	 */
	public function getProduct()
	{
		return $this->product;
	}

}