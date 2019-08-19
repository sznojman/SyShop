<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 13.07.19
 * Time: 13:42
 */

namespace App\Entity\Order;


interface CarrierInterface {

	public function getId(): ?int;
	public function setName( $name ): void;
	public function getName( ): ?string ;
	public function getCost(): float ;
	public function setCost(float $cost): void;


}