<?php

declare(strict_types=1);

namespace App\Event;

use App\Factory\Events;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class OrderIdSaveInSessionSubscriber implements EventSubscriberInterface
{
	/**
	 * @var SessionInterface
	 */
	private $session;

	public function __construct(SessionInterface $session)
	{
		$this->session = $session;
	}

	public static function getSubscribedEvents(): array
	{
		return [
			Events::ORDER_CREATED => 'onOrderCreated',
		];
	}

	public function onOrderCreated(GenericEvent $event): void
	{
		dump('pusto');
		dump($event->getSubject()->getHash());
		die('asdsad');
		$this->session->set('orderId', $event->getSubject()->getHash());
	}
}