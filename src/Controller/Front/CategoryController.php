<?php


namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController{

	/**
	 * @Route(name="singleCategory", path="/category/{id}")
	 */
	public function singleCategory( $id ) {

		$em = $this->getDoctrine()->getManager();


		return $this->render('front/category/category.html.twig',[

		]);
	}
}