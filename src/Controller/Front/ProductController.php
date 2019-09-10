<?php

namespace App\Controller\Front;


use App\Entity\Product\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController{

	/**
	 * @Route(name="singleProduct", path="/product/{id}")
	 */
	public function singleProduct( $id ) {

		$em = $this->getDoctrine()->getManager();
		$product = $em->getRepository(Product::class)->find($id);

		return $this->render('front/product/product.html.twig',[
			'product' => $product
		]);
	}
}