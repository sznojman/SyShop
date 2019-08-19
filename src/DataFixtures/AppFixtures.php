<?php

namespace App\DataFixtures;

use App\Entity\Order\Carrier;
use App\Entity\Order\Payment;
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
			$product->setName('nazwa produktu '.$i);
			$product->setQuantity($i*4);
			$product->setPrice($i*2.33+1);
			$manager->persist($product);
		}

	    for($i=0;$i < 2;$i++){
		    $payment = new Payment();
		    $payment->setName('platnosc nr'.$i);
		    $manager->persist($payment);
	    }
	    for($i=0;$i < 2;$i++){
		    $carrier = new Carrier();
		    $carrier->setName('opcja wysyłki nr'.$i);
		    $carrier->setCost(3.33*$i);


		    $manager->persist($carrier);
	    }
        $manager->flush();
    }
}
