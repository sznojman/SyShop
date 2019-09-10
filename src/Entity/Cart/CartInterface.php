<?php

namespace App\Entity\Cart;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

interface CartInterface {

	public function getId(): ?int;
	public function getHash(): ?string ;
	public function setHash($hash): void;
	public function getPayment();
	public function setPayment( $payment );
	public function getCarrier() ;
	public function setCarrier($carrier);
	public function getCartStatus() ;
	public function setCartStatus(CartStatusInterface $status);

	/**
	 * @param CartItemInterface $item
	 */
	public function addItem(CartItemInterface $item): void ;

	/**
	 * @param CartItemInterface $item
	 */
	public function removeItem(CartItemInterface $item): void ;

	/**
	 * @return ArrayCollection
	 */
	public function getItems(): Collection;


	public function setTotalCost($price): void;

	public function getTotalCost(): float ;

}