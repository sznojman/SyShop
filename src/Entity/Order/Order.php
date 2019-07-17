<?php

namespace App\Entity\Order;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="App\Repository\Order\OrderRepository")
 */
class Order implements OrderInterface
{
//    /**
//     * @ORM\Id()
//     * @ORM\GeneratedValue(strategy="UUID")
//     * @ORM\Column(type="guid",length=12)
//     */
//    protected $id;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

	/**
	 *
	 * @ORM\Column(name="hash",type="string",length=12)
	 */
	protected $hash;
	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Order\Payment")
	 * @ORM\JoinColumn(name="payment_id", referencedColumnName="id", onDelete="SET NULL")
	 */
    protected $payment;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Order\Carrier")
	 * @ORM\JoinColumn(name="carrier_id", referencedColumnName="id",onDelete="SET NULL")
	 */
    protected $carrier;

	/**
	 *
	 * @ORM\OneToMany(targetEntity="App\Entity\Order\OrderItem",mappedBy="order",cascade={"all"},orphanRemoval=true)
	 */
	protected $items;


	public function __construct() {
		$this->items = new ArrayCollection();
	}

	public function getId(): ?int
    {
        return $this->id;
    }

	/**
	 * @return Payment
	 */
	public function getPayment() {
		return $this->payment;
	}

	/**
	 * @param mixed $payment
	 */
	public function setPayment( $payment ): self {
		$this->payment = $payment;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCarrier() {
		return $this->carrier;
	}

	/**
	 * @param mixed $carrier
	 */
	public function setCarrier( $carrier ): self {
		$this->carrier = $carrier;
		return $this;
	}


	/**
	 * {@inheritdoc}
	 */
	public function addItem(OrderItemInterface $item): void
	{
		$this->items->add($item);

	}

	/**
	 * {@inheritdoc}
	 */
	public function removeItem(OrderItemInterface $item): void
	{
		$this->items->removeElement($item);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getItems(): ArrayCollection
	{
		return $this->items;
	}

	public function getHash(): ?string {
		return $this->hash;
	}
}
