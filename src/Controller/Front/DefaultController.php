<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 27.06.19
 * Time: 22:06
 */

namespace App\Controller\Front;


use App\Entity\Product\Product;
use App\Form\Order\OrderItemFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

	/**
	 * @Route("/", name="index")
	 */
	public function index(Request $request){

		$em = $this->getDoctrine()->getManager();
		$form = $this->createForm(OrderItemFormType::class);
		$products = $em->getRepository(Product::class)->findAll();

		return $this->render('front/index.html.twig',[
			'products' => $products,
			'form' => $form->createView()
		]);
	}
}