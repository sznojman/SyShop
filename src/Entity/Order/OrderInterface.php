<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 13.07.19
 * Time: 13:41
 */

namespace App\Entity\Order;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

interface OrderInterface {

	public function getId(): ?int;
	public function getHash(): ?string ;
	public function setHash($hash): void;
	public function getPayment();
	public function setPayment( $payment );
	public function getCarrier() ;
	public function setCarrier($carrier);
	/**
	 * @param OrderItemInterface $item
	 */
	public function addItem(OrderItemInterface $item): void ;

	/**
	 * @param OrderItemInterface $item
	 */
	public function removeItem(OrderItemInterface $item): void ;

	/**
	 * @return ArrayCollection
	 */
	public function getItems(): Collection;


	public function setTotalCost($price): void;

	public function getTotalCost(): float ;

}