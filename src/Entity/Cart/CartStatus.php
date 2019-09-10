<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 23.08.19
 * Time: 21:18
 */

namespace App\Entity\Cart;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity()
 * @ORM\Table(name="cart_status")
 */
class CartStatus implements CartStatusInterface{

	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	protected $id;
	/**
	 * @ORM\Column(name="name",type="string",length=255, nullable=false)
	 */
	protected $name;

	public function getId(): ?int {
		return $this->id;
	}

	public function getName(): ?string {
		return $this->name;
	}

	public function setName( string $name ): void {
		$this->name = $name;
	}

	public function __toString() {
		return $this->name;
	}
}