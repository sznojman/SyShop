<?php


namespace App\Controller\Panel;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityFrontController extends AbstractController{
	/**
	 * @Route(path="/customer_login", name="customer_login")
	 */
	public function login(AuthenticationUtils $authenticationUtils): Response
	{
		// get the login error if there is one
		$error = $authenticationUtils->getLastAuthenticationError();
		// last username entered by the user
		$lastUsername = $authenticationUtils->getLastUsername();

		return $this->render('front/login.html.twig', [
			'last_username' => $lastUsername,
			'error' => $error
		]);
	}

	/**
	 *
	 * @Route(path="/customer_logout", name="customer_logout", methods={"GET"})
	 */
	public function logout( ) {
		throw new \Exception('Don\'t forget to activate logout in security.yaml');
	}
}