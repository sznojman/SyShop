<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 23.08.19
 * Time: 21:18
 */

namespace App\Entity\Cart;


interface CartStatusInterface {

	public function getId(): ?int;

	public function getName(): ?string ;

	public function setName(string $name ): void;

	public function __toString();
}