<?php

namespace App\Controller\Front;

use App\Entity\Cart\CartItem;
use App\Entity\Product\Product;
use App\Factory\CartFactory;
use App\Form\Cart\SetCarrierType;
use App\Form\Cart\SetPaymentType;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Form\Cart\AddItemType;
use App\Form\Cart\RemoveItemType;
class CartController extends AbstractController{




	/**
	 * @var CartFactory
	 */
	private $orderFactory;

	public function __construct( CartFactory $orderFactory)
	{

		$this->orderFactory = $orderFactory;
	}


	/**
	 * @param Request $request
	 * @param CartFactory $order
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 * @Route(name="cart", path="/koszyk")
	 */
	public function cart( Request $request ,CartFactory $order) {

		$carrierForm = $this->createForm(SetCarrierType::class,$order->getCurrent());
		$paymentForm = $this->createForm(SetPaymentType::class,$order->getCurrent());

		return $this->render('front/cart/cart.html.twig',[
			'order' => $order,
			'carrierForm' => $carrierForm->createView(),
			'paymentForm' => $paymentForm->createView()
		]);
	}


	/**
	 * @param Request $request
	 *
	 * @Route(name="addToCart", path="/addToCart")
	 *
	 * @return JsonResponse
	 */
	public function addToCart(Request $request){
		$response = new JsonResponse();


		return $response;
	}



	/**
	 * @Route("/cart/addItem/{id}", name="cart.addItem", methods={"POST"})
	 */
	public function addItem(Request $request, Product $product): Response
	{

		$form = $this->createForm(AddItemType::class, $product);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			$this->orderFactory->addItem($product, 1);
			$this->addFlash('success', 'dodano do koszyka');
		}

		return $this->redirectToRoute('cart');
	}
	/**
	 * @Route("/cart/removeItem/{id}", name="cart.removeItem", methods={"POST"})
	 */
	public function removeItem(Request $request,  CartItem $product): Response
	{

		$form = $this->createForm(RemoveItemType::class, $product);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			$this->orderFactory->removeItem($product);
			$this->addFlash('success', 'usunięto z koszyka');
		}

		return $this->redirectToRoute('cart');
	}

	/**
	 * @param Product $product
	 *
	 * @return Response
	 */
	public function addItemForm(Product $product): Response
	{
		$form = $this->createForm(AddItemType::class, $product);

		return $this->render('front/cart/_addItem_form.html.twig', [
			'form' => $form->createView()
		]);
	}

	/**
	 * @param Product $product
	 *
	 * @return Response
	 */
	public function removeItemForm(CartItem $product): Response
	{
		$form = $this->createForm(RemoveItemType::class, $product);

		return $this->render('front/cart/_removeItem_form.html.twig', [
			'form' => $form->createView()
		]);
	}

}