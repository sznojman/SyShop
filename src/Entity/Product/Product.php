<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Product\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

	/**
	 * @var string
	 * @ORM\Column(name="ean",type="string",length=12, nullable=true)
	 */
	protected $ean;

	/**
	 * @var integer
	 * @ORM\Column(name="quantity",type="integer",nullable=true)
	 */
	protected $quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

	/**
	 * @return string
	 */
	public function getEan():string {
		return $this->ean;
	}

	/**
	 * @param string $ean
	 * @return self
	 */
	public function setEan( $ean ): self {
		$this->ean = $ean;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getQuantity(): ?int {
		return $this->quantity;
	}

	/**
	 * @param int $quantity
	 * @return self
	 */
	public function setQuantity( int $quantity ): self {
		$this->quantity = $quantity;
		return $this;
	}

}
