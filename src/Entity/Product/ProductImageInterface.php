<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 16.09.19
 * Time: 22:27
 */

namespace App\Entity\Product;


interface ProductImageInterface {
	public function getId(): ?int;
	public function getPath(): ?string ;
	public function setPath($path): void;
	public function setName($name): void;
	public function getName(): ?string ;
}