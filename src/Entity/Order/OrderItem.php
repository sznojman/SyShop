<?php

namespace App\Entity\Order;

use App\Entity\Product\ProductInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Order\OrderItemRepository")
 */
class OrderItem implements OrderItemInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;



	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Order\Order", inversedBy="items")
	 * @ORM\JoinColumn(name="order_id", referencedColumnName="id",onDelete="CASCADE",nullable=false)
	 */
    private $order;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Product\Product",inversedBy="orderItem")
	 * @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false)
	 */
    protected $product;

	/**
	 * @ORM\Column(type="integer")
	 */
    protected $quantity;

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

}
