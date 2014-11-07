<?php

namespace Blastar\AdminUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;


class DefaultController extends Controller
{

	public function indexAction()
	{
		
		return $this->render('BlastarAdminUserBundle:Default:index.html.twig', array(
			'user' => $this->get('security.context')->getToken()->getUser(),
			));
	}

	public function loginAction(Request $request)
	{
		$session = $request->getSession();

		// get the login error if there is one
		if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
			$error = $request->attributes->get(
					SecurityContextInterface::AUTHENTICATION_ERROR
			);
		} elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
			$error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
			$session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
		} else {
			$error = '';
		}

		// last username entered by the user
		$lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);

		return $this->render(
						'BlastarAdminUserBundle:Default:login.html.twig', array(
					'last_username' => $lastUsername,
					'error' => $error,
						)
		);
	}

}