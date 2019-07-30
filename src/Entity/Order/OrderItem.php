<?php

namespace App\Entity\Order;

use App\Entity\Product\ProductInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity(repositoryClass="App\Repository\Order\OrderItemRepository")
 */
class OrderItem implements OrderItemInterface
{
	/**
	 * @ORM\Id()
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue()
	 */
	protected $id;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Order\Order", inversedBy="items")
	 * @ORM\JoinColumn(name="order_id", referencedColumnName="id",onDelete="CASCADE",nullable=false)
	 */
	protected $order;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Product\Product")
	 * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
	 */
    protected $product;

	/**
	 * @ORM\Column(type="integer")
	 */
    protected $quantity;


	/**
	 * @var float
	 * @ORM\Column(name="priceTotal", type="float")
	 */
	private $priceTotal = 0;


    public function getId(): ?int
    {
        return $this->id;
    }

	public function getQuantity(): ?int
	{
		return $this->quantity;
	}

	/**
	 * @param integer $quantity
	 * @return void
	 */
	public function setQuantity( $quantity ): void {
		$this->quantity = $quantity;
	}

	/**
	 * @param OrderInterface $order
	 */
	public function setOrder( OrderInterface $order ): void {
		$this->order = $order;
	}

	/**
	 * @return OrderInterface
	 */
	public function getOrder(): OrderInterface {
		return $this->order;
	}


	/**
	 * {@inheritdoc}
	 */
	public function getProduct(): ProductInterface
	{
		return $this->product;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setProduct(ProductInterface $product): void
	{
		$this->product = $product;
	}

	public function setId( $id )
	{
		$this->id = $id;
	}

	/**
	 * @param float $priceTotal
	 */
	public function setPriceTotal( float $priceTotal ): void {
		$this->priceTotal = $priceTotal;
	}

	/**
	 * @return float
	 */
	public function getPriceTotal(): float {
		return $this->priceTotal;
	}
}
