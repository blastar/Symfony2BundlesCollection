<?php

namespace Admin\ProductBundle\Entity;

use Admin\WarehouseBundle\Entity\Warehouse;

/**
 * ProductPrice
 */
class ProductPrice
{
	/**
	 * @var integer
	 */
	protected $id;

	/**
	 * @var integer
	 */
	protected $price;

	/**
	 * @var integer
	 */
	protected $priceNet;

	/**
	 * @var Product
	 */
	protected $product;

	/**
	 * @var Warehouse
	 */
	protected $warehouse;

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
	 * Set price
	 *
	 * @param integer $price
	 * @return ProductPrice
	 */
	public function setPrice($price)
	{
		$this->price = $price;

		return $this;
	}

	/**
	 * Get price
	 *
	 * @return integer 
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * Set priceNet
	 *
	 * @param integer $priceNet
	 * @return ProductPrice
	 */
	public function setPriceNet($priceNet)
	{
		$this->priceNet = $priceNet;

		return $this;
	}

	/**
	 * Get priceNet
	 *
	 * @return integer 
	 */
	public function getPriceNet()
	{
		return $this->priceNet;
	}

	/**
	 * Set product
	 *
	 * @param Product $product
	 * @return ProductPrice
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

	/**
	 * Set warehouse
	 *
	 * @param Warehouse $warehouse
	 * @return ProductPrice
	 */
	public function setWarehouse(Warehouse $warehouse = null)
	{
		$this->warehouse = $warehouse;

		return $this;
	}

	/**
	 * Get warehouse
	 *
	 * @return Warehouse 
	 */
	public function getWarehouse()
	{
		return $this->warehouse;
	}

}