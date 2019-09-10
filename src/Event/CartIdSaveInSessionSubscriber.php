<?php

declare(strict_types=1);

namespace App\Event;

use App\Factory\Events;
use App\Service\Cart\CartService;
use App\Storage\CartSessionStorage;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartIdSaveInSessionSubscriber implements EventSubscriberInterface
{
	/**
	 * @var SessionInterface
	 */
	private $session;

	/**
	 * @var CartService
	 */
	private $os;
	/**
	 * @var CartSessionStorage
	 */
	private $storage;

	public function __construct(SessionInterface $session,CartSessionStorage $storage, CartService $os)
	{
		$this->session = $session;
		$this->os = $os;
		$this->storage = $storage;

	}

	public static function getSubscribedEvents(): array
	{
		return [
			Events::CART_CREATED => 'onCartCreated',
		];
	}

	public function onCartCreated(GenericEvent $event): void
	{

		$o = $event->getSubject();
		$o->setHash($this->os->generateHash());
		$this->storage->set($o->getHash());
	}
}