<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 13.07.19
 * Time: 16:08
 */

namespace App\Storage;
use App\Entity\Order\OrderInterface;

interface OrderStorageInterface {
	public function set(string $orderId): void ;

	public function get():string ;

	public function has(): bool ;

	public function remove(): void ;

	public function getOrderById(): ?OrderInterface ;

	public function getOrderByHash(): ?OrderInterface ;
}