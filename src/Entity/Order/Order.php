<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 23.08.19
 * Time: 22:50
 */

namespace App\Entity\Order;

/**
 * @ORM\Table(name="orders")
 * @ORM\Entity()
 */
class Order {

	/**
	 * @ORM\Id()
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

}