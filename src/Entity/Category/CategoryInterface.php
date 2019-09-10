<?php


namespace App\Entity\Category;


interface CategoryInterface {

	public function getId(): ?int;

	public function setName(string $name):void ;

	public function getName(): ?string ;
}