<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 13.07.19
 * Time: 15:28
 */

namespace App\Factory;


use App\Entity\Order\Order;
use App\Entity\Order\OrderInterface;
use App\Entity\Order\OrderItem;
use App\Entity\Order\OrderItemInterface;
use App\Entity\Product\ProductInterface;
use App\Service\Order\OrderService;
use App\Storage\OrderSessionStorage;
use App\Storage\OrderStorageInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use App\Factory\Events;
class OrderFactory implements OrderFactoryInterace {

	/**
	 * @var OrderStorageInterface
	 */
	private $storage;

	/**
	 * @var OrderInterface
	 */
	private $order;

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
		OrderSessionStorage $storage,
		EntityManagerInterface $entityManager,
		EventDispatcherInterface $eventDispatcher,
		OrderService $os
	)
	{
		$this->storage = $storage;
		$this->entityManager = $entityManager;
		$this->eventDispatcher = $eventDispatcher;
		$this->order = $this->getCurrent();
		$this->os = $os;
	}


	/**
	 * {@inheritdoc}
	 */
	public function getCurrent(): OrderInterface
	{
		$order = $this->storage->getOrderByHash();
		if ($order !== null) {

			return $order;
		}

		return new Order();
	}

	/**
	 * Sprawdzenie czy koszyk jest pusty.
	 *
	 * @return bool
	 */
	public function isEmpty(): bool {
		return !$this->order->getItems();
	}

	/**
	 * Sprawdzenie czy koszyk zawiera dany produkt.
	 *
	 * @param ProductInterface $product
	 *
	 * @return bool
	 */
	public function containsProduct( ProductInterface $product ): bool {


			foreach ( $this->order->getItems() as $item ) {

				if($product === $item->getProduct()){
					return true;
				}
			}
		return false;
	}

	/**
	 * Return key number of orderItem has product
	 *
	 * @param ProductInterface $product
	 *
	 * @return int|null
	 */
	public function indexOfProduct( ProductInterface $product ): ?int {
		foreach ($this->order->getItems() AS $key => $item) {
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
		$orderBeforeId = $this->order->getId();

		if (!$this->containsProduct($product)) {
			$orderItem = new OrderItem();
			$orderItem->setOrder($this->order);
			$orderItem->setProduct($product);
			$orderItem->setQuantity($quantity);
			$this->order->addItem($orderItem);

		} else {
			$key = $this->indexOfProduct($product);
			$item = $this->order->getItems()->get($key);
			$quantity = $this->order->getItems()->get($key)->getQuantity() + 1;
			$this->setItemQuantity($item, $quantity);
		}

		$this->entityManager->persist($this->order);

		// Run events
		if ($orderBeforeId === null) {
			$event = new GenericEvent($this->order);
			$this->eventDispatcher->dispatch(Events::ORDER_CREATED, $event);
		} else {
			$event = new GenericEvent($this->order);
			$this->eventDispatcher->dispatch(Events::ORDER_UPDATED, $event);
		}

		$this->entityManager->flush();


	}

	/**
	 * Aktualizacja liczby produktów dla istniejącego produktu.
	 *
	 * @param OrderItemInterface $item
	 * @param integer $quantity
	 *
	 * @throws Exception
	 */
	public function setItemQuantity( OrderItemInterface $item, int $quantity ): void {
		if ($this->order && $this->order->getItems()->contains($item)) {
			$key = $this->order->getItems()->indexOf($item);

			$item->setQuantity($quantity);

			$this->order->getItems()->set($key, $item);

			// Run events
			$event = new GenericEvent($this->order);
			$this->eventDispatcher->dispatch(Events::ORDER_UPDATED, $event);

			$this->entityManager->persist($this->order);
			$this->entityManager->flush();
		}
	}

	/**
	 * Set payment method
	 *
	 * @param PaymentInterface $payment
	 */
	public function setPayment( $payment ): void {
		if ($this->order) {
			$this->order->setPayment($payment);

			$event = new GenericEvent($this->order);
			$this->eventDispatcher->dispatch(Events::ORDER_UPDATED, $event);

			$this->entityManager->persist($this->order);
			$this->entityManager->flush();
		}
	}

	/**
	 * Set shipment
	 *
	 * @param $shipment
	 */
	public function setShipment( $shipment ): void {
		if ($this->order) {
			$this->order->setCarrier($shipment);

			$event = new GenericEvent($this->order);
			$this->eventDispatcher->dispatch(Events::ORDER_UPDATED, $event);

			$this->entityManager->persist($this->order);
			$this->entityManager->flush();
		}
	}

	/**
	 * Usunięcie pozycji produktu z koszyka.
	 *
	 * @param OrderItemInterface $item
	 *
	 * @throws Exception
	 */
	public function removeItem( OrderItemInterface $item ): void {
		if ($this->order && $this->order->getItems()->contains($item)) {
			$this->order->removeItem($item);

			// Run events
			$event = new GenericEvent($this->order);
			$this->eventDispatcher->dispatch(Events::ORDER_UPDATED, $event);

			$this->entityManager->persist($this->order);
			$this->entityManager->flush();
		}
	}

	/**
	 * Pobranie wszystkich produktów wraz z informacjami potrzebnymi na listingu koszyka.
	 *
	 * @return Collection
	 */
	public function items(): Collection {
		return $this->order->getItems();
	}

	public function getOrderItemsCount(): int {
		// TODO: Implement getOrderItemsCount() method.
		$count = 0;
		/** @var OrderItem $item */
		foreach ($this->items() as $item){
			$count += $item->getQuantity();
		}

		return $count;
	}
}