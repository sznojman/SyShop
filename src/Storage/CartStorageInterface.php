<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 13.07.19
 * Time: 16:08
 */

namespace App\Storage;
use App\Entity\Cart\CartInterface;

interface CartStorageInterface {
	public function set(string $orderId): void ;

	public function get():string ;

	public function has(): bool ;

	public function remove(): void ;

	public function getCartById(): ?CartInterface ;

	public function getCartByHash(): ?CartInterface ;
}