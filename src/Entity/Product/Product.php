<?php

namespace App\Entity\Product;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Product\ProductRepository")
 */
class Product implements ProductInterface
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


	/**
	 *@ORM\OneToMany(targetEntity="App\Entity\Order\OrderItem",mappedBy="product")
	 */
	protected $orderItem;

	/**
	 * @var string
	 * @ORM\Column(name="name",type="string",length=312, nullable=true)
	 */
	protected $name;

	public function getId(): ?int
    {
        return $this->id;
    }
	public function setId($id)
	{   $this->id = $id;

	}
	/**
	 * @return string
	 */
	public function getEan(): ?string {
		return $this->ean;
	}

	/**
	 * @param string $ean
	 * @return void
	 */
	public function setEan( $ean ): void {
		$this->ean = $ean;

	}

	/**
	 * {@inheritdoc}
	 */
	public function getName(): ?string
	{
		return $this->name;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setName(string $name): void
	{
		$this->name = $name;
	}
	/**
	 * @return int
	 */
	public function getQuantity(): ?int {
		return $this->quantity;
	}

	/**
	 * @param int $quantity
	 * @return void
	 */
	public function setQuantity( int $quantity ): void{
		$this->quantity = $quantity;

	}

	public function getOrderItem(): ArrayCollection {
		return $this->orderItem;
	}

	public function __toString(  ) {
		return (string)$this->getEan();
	}
}
