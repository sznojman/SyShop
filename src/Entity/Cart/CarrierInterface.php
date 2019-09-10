<?php

namespace App\Entity\Cart;


interface CarrierInterface {

	public function getId(): ?int;
	public function setName( $name ): void;
	public function getName( ): ?string ;
	public function getCost(): float ;
	public function setCost(float $cost): void;


}