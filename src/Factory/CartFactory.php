<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 13.07.19
 * Time: 15:28
 */

namespace App\Factory;

use App\Entity\Cart\Cart;
use App\Entity\Cart\CartInterface;
use App\Entity\Cart\CartItem;
use App\Entity\Cart\CartItemInterface;
use App\Entity\Product\ProductInterface;
use App\Service\Cart\CartService;
use App\Storage\CartSessionStorage;
use App\Storage\CartStorageInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use App\Factory\Events;

class CartFactory implements CartFactoryInterace {

	/**
	 * @var CartStorageInterface
	 */
	private $storage;

	/**
	 * @var CartInterface
	 */
	private $Cart;

	/**
	 * @var EntityManagerInterface
	 */
	private $entityManager;

	/**
	 * @var EventDispatcherInterface
	 */
	private $eventDispatcher;
	/**
	 * @var EventDispatcherInterface
	 */
	private $os;

	public function __construct(
		CartSessionStorage $storage,
		EntityManagerInterface $entityManager,
		EventDispatcherInterface $eventDispatcher,
		CartService $os
	)
	{
		$this->storage = $storage;
		$this->entityManager = $entityManager;
		$this->eventDispatcher = $eventDispatcher;
		$this->Cart = $this->getCurrent();
		$this->os = $os;
	}


	/**
	 * {@inheritdoc}
	 */
	public function getCurrent(): CartInterface
	{
		$Cart = $this->storage->getCartByHash();
		if ($Cart !== null) {

			return $Cart;
		}

		return new Cart();
	}

	/**
	 * Sprawdzenie czy koszyk jest pusty.
	 *
	 * @return bool
	 */
	public function isEmpty(): bool {
		return !$this->Cart->getItems();
	}

	/**
	 * Sprawdzenie czy koszyk zawiera dany produkt.
	 *
	 * @param ProductInterface $product
	 *
	 * @return bool
	 */
	public function containsProduct( ProductInterface $product ): bool {


			foreach ( $this->Cart->getItems() as $item ) {

				if($product === $item->getProduct()){
					return true;
				}
			}
		return false;
	}

	/**
	 * Return key number of CartItem has product
	 *
	 * @param ProductInterface $product
	 *
	 * @return int|null
	 */
	public function indexOfProduct( ProductInterface $product ): ?int {
		foreach ($this->Cart->getItems() AS $key => $item) {
			if ($item->getProduct() === $product) {
				return $key;
			}
		}
		return null;
	}

	/**
	 * Usunięcie wszystkich elementów z koszyka.
	 */
	public function clear(): void {
		// TODO: Implement clear() method.
	}

	/**
	 * Dodanie produktu do koszyka.
	 * Jeśli produkt istnieje zwiększana jest jego ilość.
	 *
	 * @param ProductInterface $product
	 * @param integer $quantity
	 *
	 * @return void
	 */
	public function addItem( ProductInterface $product, int $quantity ): void {
		$CartBeforeId = $this->Cart->getId();

		if (!$this->containsProduct($product)) {
			$CartItem = new CartItem();
			$CartItem->setCart($this->Cart);
			$CartItem->setProduct($product);
			$CartItem->setQuantity($quantity);
			$this->Cart->addItem($CartItem);

		} else {
			$key = $this->indexOfProduct($product);
			$item = $this->Cart->getItems()->get($key);
			$quantity = $this->Cart->getItems()->get($key)->getQuantity() + 1;
			$this->setItemQuantity($item, $quantity);
		}

		$this->entityManager->persist($this->Cart);

		// Run events
		if ($CartBeforeId === null) {
			$event = new GenericEvent($this->Cart);
			$this->eventDispatcher->dispatch(Events::CART_CREATED, $event);
		} else {
			$event = new GenericEvent($this->Cart);
			$this->eventDispatcher->dispatch(Events::CART_UPDATED, $event);
		}

		$this->entityManager->flush();


	}

	/**
	 * Aktualizacja liczby produktów dla istniejącego produktu.
	 *
	 * @param CartItemInterface $item
	 * @param integer $quantity
	 *
	 * @throws Exception
	 */
	public function setItemQuantity( CartItemInterface $item, int $quantity ): void {
		if ($this->Cart && $this->Cart->getItems()->contains($item)) {
			$key = $this->Cart->getItems()->indexOf($item);

			$item->setQuantity($quantity);

			$this->Cart->getItems()->set($key, $item);

			// Run events
			$event = new GenericEvent($this->Cart);
			$this->eventDispatcher->dispatch(Events::CART_UPDATED, $event);

			$this->entityManager->persist($this->Cart);
			$this->entityManager->flush();
		}
	}

	/**
	 * Set payment method
	 *
	 * @param PaymentInterface $payment
	 */
	public function setPayment( $payment ): void {
		if ($this->Cart) {
			$this->Cart->setPayment($payment);

			$event = new GenericEvent($this->Cart);
			$this->eventDispatcher->dispatch(Events::CART_UPDATED, $event);

			$this->entityManager->persist($this->Cart);
			$this->entityManager->flush();
		}
	}

	/**
	 * Set shipment
	 *
	 * @param $shipment
	 */
	public function setShipment( $shipment ): void {
		if ($this->Cart) {
			$this->Cart->setCarrier($shipment);

			$event = new GenericEvent($this->Cart);
			$this->eventDispatcher->dispatch(Events::CART_UPDATED, $event);

			$this->entityManager->persist($this->Cart);
			$this->entityManager->flush();
		}
	}

	/**
	 * Usunięcie pozycji produktu z koszyka.
	 *
	 * @param CartItemInterface $item
	 *
	 * @throws Exception
	 */
	public function removeItem( CartItemInterface $item ): void {
		if ($this->Cart && $this->Cart->getItems()->contains($item)) {
			$this->Cart->removeItem($item);

			// Run events
			$event = new GenericEvent($this->Cart);
			$this->eventDispatcher->dispatch(Events::CART_UPDATED, $event);

			$this->entityManager->persist($this->Cart);
			$this->entityManager->flush();
		}
	}

	/**
	 * Pobranie wszystkich produktów wraz z informacjami potrzebnymi na listingu koszyka.
	 *
	 * @return Collection
	 */
	public function items(): Collection {
		return $this->Cart->getItems();
	}

	public function getCartItemsCount(): int {
		$count = 0;
		/** @var CartItem $item */
		foreach ($this->items() as $item){
			$count += $item->getQuantity();
		}

		return $count;
	}
}