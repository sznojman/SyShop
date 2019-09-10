<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 13.07.19
 * Time: 14:06
 */

namespace App\Entity\Product;
use Doctrine\Common\Collections\ArrayCollection;

interface ProductInterface {

	public function getId(): ?int;

	/**
	 * @return string
	 */
	public function getEan(): ?string ;

	/**
	 * @param string $ean
	 * @return void
	 */
	public function setEan( $ean ): void ;

	public function setName(string $name):void ;

	public function getName(): ?string ;
	/**
	 * @return int
	 */
	public function getQuantity(): ?int;

	/**
	 * @param int $quantity
	 * @return void
	 */
	public function setQuantity( int $quantity ): void;

	public function getCartItem(): ArrayCollection ;

	public function getPrice():float;

	public function setPrice($price): void;
}