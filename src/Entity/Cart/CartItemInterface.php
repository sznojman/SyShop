<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 13.07.19
 * Time: 13:42
 */

namespace App\Entity\Cart;


use App\Entity\Product\ProductInterface;
use App\Entity\Cart\CartInterface;

interface CartItemInterface {

	public function getId(): ?int;

	public function getQuantity(): ?int;

	public function setQuantity( $quantity ): void;

	/**
	 * @param CartInterface $order
	 */
	public function setCart(CartInterface $order): void ;

	/**
	 * @return CartInterface
	 */
	public function getCart(): CartInterface ;

	/**
	 * @param ProductInterface $product
	 */
	public function setProduct(ProductInterface $product): void ;

	/**
	 * @return ProductInterface
	 */
	public function getProduct(): ProductInterface ;

	/**
	 * @param float $priceTotal
	 */
	public function setPriceTotal(float $priceTotal): void ;

	/**
	 * @return float
	 */
	public function getPriceTotal(): float ;


}