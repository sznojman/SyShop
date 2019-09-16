<?php
/**
 * Created by PhpStorm.

 * Date: 23.08.19
 * Time: 22:50
 */

namespace App\Entity\Order;
use Doctrine\ORM\Mapping as ORM;
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