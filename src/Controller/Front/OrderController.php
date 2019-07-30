<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 10.07.19
 * Time: 21:27
 */

namespace App\Controller\Front;

use App\Entity\Order\OrderItem;
use App\Entity\Product\Product;
use App\Factory\OrderFactory;
use App\Storage\OrderSessionStorage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Order\Order;
use App\Entity\Order\OrderInterface;
use App\Form\Cart\AddItemType;
use App\Form\Cart\RemoveItemType;
class OrderController extends AbstractController{




	/**
	 * @var OrderFactory
	 */
	private $orderFactory;

	public function __construct( OrderFactory $orderFactory)
	{

		$this->orderFactory = $orderFactory;
	}


	/**
	 * @param Request $request
	 * @param OrderFactory $order
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 * @Route(name="cart", path="/koszyk")
	 */
	public function cart( Request $request ,OrderFactory $order) {



		return $this->render('front/order/cart.html.twig',[
			'order' => $order
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
	public function removeItem(Request $request,  OrderItem $product): Response
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

		return $this->render('front/order/_addItem_form.html.twig', [
			'form' => $form->createView()
		]);
	}

	/**
	 * @param Product $product
	 *
	 * @return Response
	 */
	public function removeItemForm(OrderItem $product): Response
	{
		$form = $this->createForm(RemoveItemType::class, $product);

		return $this->render('front/order/_removeItem_form.html.twig', [
			'form' => $form->createView()
		]);
	}

}