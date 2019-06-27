<?php

namespace App\Entity\Order;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="App\Repository\Order\OrderRepository")
 */
class Order
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

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


}
