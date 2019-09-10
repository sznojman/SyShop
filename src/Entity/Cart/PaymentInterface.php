<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 13.07.19
 * Time: 13:43
 */

namespace App\Entity\Cart;


interface PaymentInterface {

	public function getId(): ?int;
	public function getName(): ?string ;
	public function setName(string $name ): void;
}