<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Product\Product;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

		for($i=0;$i < 15;$i++){
			$product = new Product();
			$product->setEan('ean'.$i);
			$product->setQuantity($i*4);
			$manager->persist($product);
		}
        $manager->flush();
    }
}
