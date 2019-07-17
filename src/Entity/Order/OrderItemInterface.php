<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 13.07.19
 * Time: 13:42
 */

namespace App\Entity\Order;


use App\Entity\Product\ProductInterface;
use App\Entity\Order\OrderInterface;

interface OrderItemInterface {

	public function getId(): ?int;

	public function getQuantity(): ?int;

	public function setQuantity( $quantity ): void;

	/**
	 * @param OrderInterface $order
	 */
	public function setOrder(OrderInterface $order): void ;

	/**
	 * @return OrderInterface
	 */
	public function getOrder(): OrderInterface ;

	/**
	 * @param ProductInterface $product
	 */
	public function setProduct(ProductInterface $product): void ;

	/**
	 * @return ProductInterface
	 */
	public function getProduct(): ProductInterface ;


}