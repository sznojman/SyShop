<?php


namespace App\Factory;

final class Events
{
	/**
	 * @Event("Symfony\Component\EventDispatcher\GenericEvent")
	 * @var string
	 */
	public const CART_CREATED = 'cart.created';

	/**
	 * @Event("Symfony\Component\EventDispatcher\GenericEvent")
	 * @var string
	 */
	public const CART_UPDATED = 'cart.updated';
}