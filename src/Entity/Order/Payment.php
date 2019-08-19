<?php

namespace App\Entity\Order;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Order\PaymentRepository")
 */
class Payment implements PaymentInterface
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

    public function getId(): ?int
    {
        return $this->id;
    }

	/**
	 * @return mixed
	 */
	public function getName(): ?string {
		return $this->name;
	}

	/**
	 * @param mixed $name
	 * @return void
	 */
	public function setName(string $name ): void {
		$this->name = $name;
	}
}
