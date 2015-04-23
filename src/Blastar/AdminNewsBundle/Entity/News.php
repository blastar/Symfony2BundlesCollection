<?php

namespace Blastar\AdminNewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * News
 */
class News
{
	/**
	 * @var integer
	 */
	private $id;

	/**
	 * @var string
	 */
	private $title;

	/**
	 * @var string
	 */
	private $header;

	/**
	 * @var string
	 */
	private $content;

	/**
	 * @var \DateTime
	 */
	private $createdAt;

	/**
	 * @var \DateTime
	 */
	private $modifiedAt;

	/**
	 * @var boolean
	 */
	private $isEnabled;

	/**
	 * @var string
	 */
	private $url;

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
	 * Set title
	 *
	 * @param string $title
	 * @return News
	 */
	public function setTitle($title)
	{
		$this->title = $title;

		return $this;
	}

	/**
	 * Get title
	 *
	 * @return string 
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Set header
	 *
	 * @param string $header
	 * @return News
	 */
	public function setHeader($header)
	{
		$this->header = $header;

		return $this;
	}

	/**
	 * Get header
	 *
	 * @return string 
	 */
	public function getHeader()
	{
		return $this->header;
	}

	/**
	 * Set content
	 *
	 * @param string $content
	 * @return News
	 */
	public function setContent($content)
	{
		$this->content = $content;

		return $this;
	}

	/**
	 * Get content
	 *
	 * @return string 
	 */
	public function getContent()
	{
		return $this->content;
	}

	/**
	 * Set createdAt
	 *
	 * @param \DateTime $createdAt
	 * @return News
	 */
	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;

		return $this;
	}

	/**
	 * Get createdAt
	 *
	 * @return \DateTime 
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	/**
	 * Set modifiedAt
	 *
	 * @param \DateTime $modifiedAt
	 * @return News
	 */
	public function setModifiedAt($modifiedAt)
	{
		$this->modifiedAt = $modifiedAt;

		return $this;
	}

	/**
	 * Get modifiedAt
	 *
	 * @return \DateTime 
	 */
	public function getModifiedAt()
	{
		return $this->modifiedAt;
	}

	/**
	 * Set isEnabled
	 *
	 * @param boolean $isEnabled
	 * @return News
	 */
	public function setIsEnabled($isEnabled)
	{
		$this->isEnabled = $isEnabled;

		return $this;
	}

	/**
	 * Get isEnabled
	 *
	 * @return boolean 
	 */
	public function getIsEnabled()
	{
		return $this->isEnabled;
	}

	function getUrl()
	{
		return $this->url;
	}

	function setUrl($url)
	{
		$this->url = $url;
	}

}