<?php
/**
 * Created by PhpStorm.
 * Date: 17.09.19
 * Time: 21:29
 */

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 *
 * @Route(name="admin", path="/admin")
 */
class CockpitController extends AbstractController{
	/**
	 * @Route(name="cockpit", path="/")
	 */
	public function index(Request $request){
		return $this->render('admin/default/index.html.twig');
	}

}