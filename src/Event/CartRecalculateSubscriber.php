<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 18.07.19
 * Time: 22:45
 */

namespace App\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Factory\Events;
use App\Entity\Cart\Cart;
use App\Entity\Cart\CartItem;

class CartRecalculateSubscriber implements EventSubscriberInterface{

	/**
	 * Returns an array of event names this subscriber wants to listen to.
	 *
	 * The array keys are event names and the value can be:
	 *
	 *  * The method name to call (priority defaults to 0)
	 *  * An array composed of the method name to call and the priority
	 *  * An array of arrays composed of the method names to call and respective
	 *    priorities, or 0 if unset
	 *
	 * For instance:
	 *
	 *  * ['eventName' => 'methodName']
	 *  * ['eventName' => ['methodName', $priority]]
	 *  * ['eventName' => [['methodName1', $priority], ['methodName2']]]
	 *
	 * @return array The event names to listen to
	 */
	public static function getSubscribedEvents() {
		return [
			Events::CART_CREATED => 'recalculate',
			Events::CART_UPDATED => 'recalculate',
		];
	}

	public function recalculate(GenericEvent $event){

		$totalCart = 0;
		/*  @var $order Cart */
		$order = $event->getSubject();
		$items = $order->getItems();
		/*  @var $item CartItem */
		foreach ( $items as $item ) {
			$qty = $item->getQuantity();
			$price = $item->getProduct()->getPrice();
			$totalPrice = $qty*$price;
			$item->setPriceTotal($totalPrice);
			$totalCart += $totalPrice;
		}
		$order->setTotalCost($totalCart);

	}

}