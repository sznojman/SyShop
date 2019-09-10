<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 13.07.19
 * Time: 16:12
 */

namespace App\Storage;


use App\Entity\Cart\Cart;
use App\Entity\Cart\CartInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartSessionStorage implements CartStorageInterface {

	private const ORDER_KEY_NAME = 'orderHash';

	/**
	 * @var EntityManagerInterface
	 */
	private $entityManager;

	/**
	 * @var SessionInterface
	 */
	private $session;

	public function __construct(EntityManagerInterface $entityManager, SessionInterface $session)
	{
		$this->entityManager = $entityManager;
		$this->session = $session;
	}
	public function set( string $orderId ): void {

		$this->session->set(self::ORDER_KEY_NAME,$orderId);
	}

	public function get(): string {
		return $this->session->get(self::ORDER_KEY_NAME);
	}

	public function has(): bool {
		return $this->session->has(self::ORDER_KEY_NAME);
	}

	public function remove(): void {
		$this->session->remove(self::ORDER_KEY_NAME);
	}

	public function getCartById(): ?CartInterface {

		if ($this->has()) {
			$order = $this->entityManager->getRepository(Cart::class)->findOneById($this->get());
			return $order;
		}
		return null;
	}

	public function getCartByHash(): ?CartInterface {

		if ($this->has()) {
			$order = $this->entityManager->getRepository(Cart::class)->findOneByHash($this->get());
			return $order;
		}
		return null;
	}
}