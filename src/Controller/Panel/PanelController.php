<?php


namespace App\Controller\Panel;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/panel")
 */
class PanelController extends AbstractController {

	/**
	 * @param Request $request
	 *
	 * @Route("/", name="panel")
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function index(Request $request){
		return $this->render('/panel/default:index.html.twig',[

		]);
	}

}