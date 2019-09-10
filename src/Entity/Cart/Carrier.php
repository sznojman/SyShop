<?php

namespace App\Entity\Cart;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Cart\CarrierRepository")
 */
class Carrier implements CarrierInterface
{
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
	/**
	 * @var float
	 * @ORM\Column(name="cost", type="float")
	 */
	protected $cost;

    public function getId(): ?int
    {
        return $this->id;
    }

	/**
	 * @return mixed
	 */
	public function getName():?string{
		return $this->name;
	}

	/**
	 * @param mixed $name
	 * @return self
	 */
	public function setName( $name ): void {
		$this->name = $name;
	}

	/**
	 * @return float
	 */
	public function getCost(): float {
		return $this->cost;
	}

	/**
	 * @param float $cost
	 */
	public function setCost( float $cost ): void {
		$this->cost = $cost;
	}



}
