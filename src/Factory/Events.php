<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 15.07.19
 * Time: 17:59
 */

namespace App\Factory;

final class Events
{
	/**
	 * @Event("Symfony\Component\EventDispatcher\GenericEvent")
	 * @var string
	 */
	public const ORDER_CREATED = 'order.created';

	/**
	 * @Event("Symfony\Component\EventDispatcher\GenericEvent")
	 * @var string
	 */
	public const ORDER_UPDATED = 'order.updated';
}