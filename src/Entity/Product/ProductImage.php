<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Product\ProductImageRepository")
 */
class ProductImage implements ProductImageInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
	/**
	 * @var string
	 * @ORM\Column(name="name",type="string",length=255, nullable=true)
	 */
    private $name;
	/**
	 * @var string
	 * @ORM\Column(name="path",type="string",length=340, nullable=false)
	 */
    private $path;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setName( $name ): void {
	    $this->name = $name;
    }

    public function getName(): ?string {
	   return $this->name;
    }
    public function getPath(): ?string {
		return $this->path;
	}
	public function setPath( $path ): void {
		$this->path = $path;
	}
}
