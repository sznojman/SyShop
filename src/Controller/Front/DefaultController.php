<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 27.06.19
 * Time: 22:06
 */

namespace App\Controller\Front;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

	/**
	 * @Route("/", name="index")
	 */
	public function index(Request $request){
		return $this->render('front/index.html.twig');
	}
}