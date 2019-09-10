<?php

namespace App\Entity\Category;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Category\CategoryRepository")
 */
class Category implements CategoryInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;


	/**
	 * @var string
	 * @ORM\Column(name="name",type="string",length=312, nullable=true)
	 */
	protected $name;




    public function getId(): ?int
    {
        return $this->id;
    }


	public function setName( string $name ): void {
		$this->name = $name;
	}

	public function getName(): ?string {
		return $this->name;
	}
}
