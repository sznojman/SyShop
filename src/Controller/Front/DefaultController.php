<?php


namespace App\Controller\Front;


use App\Entity\Product\Product;
use App\Form\Cart\CartItemFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

	/**
	 * @Route("/", name="index")
	 */
	public function index(Request $request){

		$em = $this->getDoctrine()->getManager();
		$form = $this->createForm(CartItemFormType::class);
		$products = $em->getRepository(Product::class)->findAll();

		return $this->render('front/default/index.html.twig',[
			'products' => $products,
			'form' => $form->createView()
		]);
	}
}