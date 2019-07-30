<?php

declare(strict_types=1);

namespace App\Event;

use App\Factory\Events;
use App\Service\Order\OrderService;
use App\Storage\OrderSessionStorage;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class OrderIdSaveInSessionSubscriber implements EventSubscriberInterface
{
	/**
	 * @var SessionInterface
	 */
	private $session;

	/**
	 * @var OrderService
	 */
	private $os;
	/**
	 * @var OrderSessionStorage
	 */
	private $storage;

	public function __construct(SessionInterface $session,OrderSessionStorage $storage, OrderService $os)
	{
		$this->session = $session;
		$this->os = $os;
		$this->storage = $storage;

	}

	public static function getSubscribedEvents(): array
	{
		return [
			Events::ORDER_CREATED => 'onOrderCreated',
		];
	}

	public function onOrderCreated(GenericEvent $event): void
	{

		$o = $event->getSubject();
		$o->setHash($this->os->generateHash());
		$this->storage->set($o->getHash());
	}
}